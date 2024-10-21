<?php
/*
This guide complements a section from my video course, “Mastering Laravel Project Structure.”
Here’s where you can relocate your Controller logic:

- Form Requests: Streamline data validation.
- Eloquent Mutators: Adjust data during database interactions.
- Eloquent Observers: Respond to specific model events.
- Service Classes: Group your business logic.
- Action Classes: Handle individual tasks.
- Jobs: Manage background tasks.
- Events and Listeners: Coordinate app events and reactions.
- Global Helpers: Handy functions available everywhere.
- Traits: Code snippets you can use across multiple classes.
- Base Controllers: Controllers with shared functionalities.
- Repository Classes: Centralize interactions with your database.

Let’s get started.

# Simplifying Your Controller Code

    Let’s dive into how you can organize a chunky controller and make it more concise. Here’s the starting code:

    public function store(Request $request)
    {
        $this->authorize('user_create');
        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $userData['start_at'] = Carbon::createFromFormat('m/d/Y', $request->start_at)->format('Y-m-d');
        $userData['password'] = bcrypt($request->password);
        $user = User::create($userData);
        $user->roles()->sync($request->input('roles', []));
        Project::create(['user_id' => $user->id, 'name' => 'Demo project 1']);
        Category::create(['user_id' => $user->id, 'name' => 'Demo category 1']);
        Category::create(['user_id' => $user->id, 'name' => 'Demo category 2']);
        MonthlyReport::where('month', now()->format('Y-m'))->increment('users_count');
        $user->sendEmailVerificationNotification();
        $admins = User::where('is_admin', 1)->get();
        Notification::send($admins, new AdminNewUserNotification($user));
        return response()->json(['result' => 'success', 'data' => $user], 200);
    }

    Note: Remember, it’s about what feels right to you. The options below are just suggestions, and you’re free to pick what suits your needs best.

# Simplifying Laravel Validation with Form Request

    Validation is a key part of any Laravel application, ensuring that the data being processed is correct and useful. Especially when dealing with numerous fields, validation can make your code cluttered. Let’s simplify this.
    Firstly, we will shift validation rules into a Form Request. This not only pertains to data validation but also to permissions.
    To create a Form Request, execute the following command:

    php artisan make:request StoreUserRequest

    This creates a new file `app\Http\Requests\StoreUserRequest.php` with two crucial methods: `authorize()` for permission and `rules()` for data validation.
    Your Form Request should look something like this:

    namespace App\Http\Requests;
    use Illuminate\Foundation\Http\FormRequest;
    class StoreUserRequest extends FormRequest
    {
        public function authorize()
        {
            return Gate::allows('user_create');
        }
        public function rules()
        {
            return [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
            ];
        }
    }

    In your Controller, use the `StoreUserRequest` instead of the default `Request`. You can then access the validated data directly by calling the `validated()` method from the Request.
    For instance, your Controller might look like this:

    public function store(StoreUserRequest $request)
    {
        $userData = $request->validated();
        $userData['start_at'] = Carbon::createFromFormat('m/d/Y', $request->start_at)->format('Y-m-d');
        $userData['password'] = bcrypt($request->password);
        $user = User::create($userData);
        $user->roles()->sync($request->input('roles', []));
        // ...
    }

    This minor tweak substantially declutters the Controller, making your code more organized and manageable.

# Simplifying Data Modification with Laravel’s Eloquent: Mutators vs. Observers

    Imagine you need to adjust some data before it gets saved in the database, like date formatting or password encryption. Instead of doing this within the Controller, Laravel’s Eloquent provides efficient tools: Mutators and Observers. Let’s see how they work.

    - Mutators:

    Mutators allow you to handle attribute values of a model before saving them to the database. There are two main approaches to define Mutators based on your Laravel version:
    For Laravel 9 and older:

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    From Laravel 9 onwards:

    protected function startAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d')
        );
    }
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }

# Observers:

    Observers give you methods that get triggered during the lifecycle of a model, like when an entry is being created or updated.
    To generate an Observer for the User model, use:

    php artisan make:observer UserObserver --model=User

    Here’s an example of how you could set up an Observer to modify data before a record is created:

    namespace App\Observers;
    class UserObserver
    {
        public function creating(User $user)
        {
            $user->start_at = Carbon::createFromFormat('m/d/Y', $user->start_at)->format('Y-m-d');
            $user->password = bcrypt($user->password);
        }
    }

    Do note that some methods, like `creating()`, might not be officially documented, suggesting they're not always the recommended approach.
    Considering ease and official Laravel guidelines, Mutators are generally preferred for such data modifications.
    Now, with these data modifications handled outside the Controller, the code becomes cleaner:

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));
        // ...
    }

    This illustrates how, with the right tools, Laravel aids in producing neat and maintainable code.

# Streamlining Controllers with Service Classes in Laravel

    Next, in our journey to tidy up the Controller, we’re delving into the core logic responsible for saving data in the database. A dedicated Service class will be our ally for this task.
    Service classes don’t have a specific artisan command for creation, so we’ll craft one manually. Let’s develop a `UserService.php` file within the `app/Services` directory, housing the logic to create a user:

    namespace App\Services;
    use App\Models\User;
    class UserService
    {
        public function create(array $userData): User
        {
            $user = User::create($userData);
            $user->roles()->sync($userData['roles']);
            
            return $user;
        }
    }

    In the `UserService`, we introduced a `create()` method that takes validated data as its input, orchestrates the user creation, syncs roles, and subsequently returns the fresh user.
    Now, aiming to utilize this service within our Controller, we encounter multiple paths. Let’s uncover them:
    Instantly initiating the service within the Controller, passing the validated data to our `create()` method.

    $user = (new UserService())->create($request->validated());

    Employing dependency injection to introduce the service into our Controller method, enabling a neat and efficient way to access our service functions.

    public function store(StoreUserRequest $request, UserService $userService)
    {
        $user = $userService->create($request->validated());
        // ...
    }

    Opting for the service class approach elevates the organization of our code, fostering readability and maintenance by keeping the Controller lean and focused.

# Service and Action Classes in Laravel: Understanding the Differences

    In Laravel’s vast ecosystem, both Service and Action classes offer organized ways to manage logic. They seem similar but are utilized based on how you prefer structuring your application’s logic. Let’s unravel these concepts with simplicity.
    An Action class is precise, typically dedicated to a single operation. Unlike Service classes, there’s no built-in Artisan command to generate Action classes. So, you’ll create one manually.
    Consider an `Action` class to manage user creation:

    namespace App\Actions;
    use App\Models\User;
    class CreateUserAction
    {
        public function execute(array $userData): User
        {
            $user = User::create($userData);
            $user->roles()->sync($userData['roles']);
            
            return $user;
        }
    }

    To implement this `Action` in your Controller, you'd instantiate the class and execute its method, passing the necessary data:

    public function store(StoreUserRequest $request)
    {
        $user = (new CreateUserAction())->execute($request->validated());
        // ...
    }

    Comparing Service and Action classes, one might ask: “What sets them apart?” It largely hinges on how you prefer to segment your application’s logic:

    1. Service Classes: These lean towards encompassing operations related to a particular model or entity, such as `UserService` or `TaskService`. They might have multiple methods reflecting various tasks related to that entity.
    2. Action Classes: These encapsulate individual operations or actions, like `CreateUserAction` or `UpdateTaskAction`. Typically, they have one primary method, but they can also encompass additional private methods for more intricate logic.

    To sum it up, the choice between Service and Action classes isn’t about one being superior; it’s about how you want to structure and convey the operations in your application. Both paradigms aim to promote cleaner, more organized code. So, pick the one that aligns with your coding philosophy and the specific requirements of your project.

# Understanding Jobs and Background Tasks in Laravel

    Jobs: In Laravel, Jobs are tasks that can be run in the background. They’re like Actions, but with an added advantage — they can be queued. This means you can delay their execution to avoid any immediate load on the application.
    Creating a Job is straightforward, thanks to Laravel’s Artisan:

    php artisan make:job NewUserDataJob

    Here’s how a basic Job looks:

    use App\Models\Project;
    use App\Models\Category;
    class NewUserDataJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
        public $user;
        public function __construct(User $user)
        {
            $this->user = $user;
        }
        public function handle()
        {
            Project::create([
                'user_id' => $this->user->id,
                'name' => 'Sample Project',
            ]);
            Category::create([
                'user_id' => $this->user->id,
                'name' => 'Sample Category 1',
            ]);
            Category::create([
                'user_id' => $this->user->id,
                'name' => 'Sample Category 2',
            ]);
        }
    }

    To use this Job in a Controller, you simply dispatch it:

    public function store(StoreUserRequest $request)
    {
        $user = (new CreateUserAction())->execute($request->validated());
        NewUserDataJob::dispatch($user);
        // ... further code
    }

    Queues: After dispatching the job, Laravel handles the background task through a queue system. Remember, for queues to work efficiently, you must set up and manage the queue worker, which is a separate process.

# Harnessing the Power of Events and Listeners in Laravel

    In Laravel, Events and Listeners offer a nifty way to trigger and handle actions in response to certain events. It’s like setting an alarm: when the event (or alarm) goes off, any listeners tuned in respond accordingly.
    Start by creating an Event for registering a new user:

    php artisan make:event NewUserRegistered

    Next, create a Listener that waits for the `NewUserRegistered` event:

    php artisan make:listener MonthlyReportUpdateListener

    In your Controller, dispatch the event just like you’d do for a job:

    public function register(RegistrationRequest $request)
    {
        $user = (new RegisterUserAction())->execute($request->validated());
        NewUserDataJob::dispatch($user);
        NewUserRegistered::dispatch($user);
        //...
    }

    The `NewUserRegistered` event accepts a user as an argument, so our listeners can access this user:

    class NewUserRegistered
    {
        public function __construct(public User $user) { }
    }

    And in the `EventServiceProvider`, link the event to its listener:

    class EventServiceProvider extends ServiceProvider
    {
        protected $listen = [
            NewUserRegistered::class => [
                MonthlyReportUpdateListener::class,
                // other listeners...
            ],
        ];
    }

    Inside the `MonthlyReportUpdateListener`, increment the monthly user count:

    class MonthlyReportUpdateListener
    {
        public function handle(NewUserRegistered $event)
        {
            MonthlyReport::where('month', now()->format('Y-m'))->increment('users_count');
        }
    }

    Laravel itself uses events and listeners. For instance, email verification notifications are automatically triggered by the `Registered` event.
    You can extend this further. Maybe you want to notify admins when a new user joins:

    php artisan make:listener NotifyAdminsOfNewUser

    Then, in this new listener, notify the admin users:

    class NotifyAdminsOfNewUser
    {
        public function handle(NewUserRegistered $event)
        {
            $admins = User::where('is_admin', 1)->get();
            Notification::send($admins, new NewUserAdminNotification($event->user));
        }
    }

    Your controller now becomes streamlined:

    public function register(RegistrationRequest $request)
    {
        $user = (new RegisterUserAction())->execute($request->validated());
        NewUserDataJob::dispatch($user);
        NewUserRegistered::dispatch($user);
        return response()->json(['status' => 'success', 'user' => $user], 200);
    }

    With just these steps, you’ve drastically reduced your controller’s size and made your application more modular and event-driven.

# Using Global Helpers in Laravel

    Helper classes in Laravel are super handy. Think of them as a toolbox filled with various tools (methods) for specific tasks. For instance, a `DateHelper` can assist with date manipulations, while a `CurrencyHelper` can help with currency conversions.
    Let’s break down a practical use case to understand it better:
    Suppose you’ve got an attribute called `startAt` in your User model. This attribute has a date format manipulation:

    protected function startAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
        );
    }

    To make this code reusable, let’s transfer the date conversion logic to a helper.
    Make a new file at `app/Helpers/DateHelper.php`. (Laravel doesn't have a built-in command for this, so you'll need to create it manually.)
    In this new `DateHelper` class, let's create a method named `convertToDB`:

    namespace App\Helpers;
    use Carbon\Carbon;
    class DateHelper
    {
        public static function convertToDB($date)
        {
            return Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
        }
    }

    Now, head back to your User model and update the `startAt` attribute to make use of this new helper:

    protected function startAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => DateHelper::convertToDB($value);
        );
    }

    You’ve now organized your date manipulation logic in a centralized location. Anytime you need to convert dates in this format for the database, just call this helper. It makes your code tidier, more readable, and easily maintainable.

# Managing Repeated Parts in Laravel: Traits or Base Controller?

    Handling repeated tasks efficiently is crucial when working with Laravel, especially in API controllers where response consistency is key. You can streamline your process by using either a Base Controller or Traits to manage repeated parts such as responses.
    A straightforward method is to incorporate the logic directly within the Base Controller (`app/Http/Controllers/Controller.php`).
    Here is how you can structure it:

    class Controller extends BaseController
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        public function respondOk($data)
        {
            return response()->json([
                'result' => 'success',
                'data' => $data,
            ], 200);
        }
    }

    Then, in your typical controllers, you can effortlessly call this response method:

    public function store(StoreUserRequest $request)
    {
        $user = (new CreateUserAction())->execute($request->validated());
        NewUserDataJob::dispatch($user);
        NewUserRegistered::dispatch($user);
    return $this->respondOk($user);
    }

    Traits offer another elegant solution. You can create a trait to house your response logic.
    Firstly, create a trait, for instance `app/Traits/APIResponsesTrait.php`, and define the necessary method:

    namespace App\Traits;
    trait APIResponsesTrait
    {
        public function respondOk($data)
        {
            return response()->json([
                'result' => 'success',
                'data' => $data,
            ], 200);
        }
    }

    Next, you can seamlessly integrate this trait into either each controller or even the Base Controller:

    class Controller extends BaseController
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        use APIResponsesTrait;
    }

    Subsequently, within your controllers, you can invoke the `respondOk` method in a clean and simple manner:

    public function store(StoreUserRequest $request)
    {
        $user = (new CreateUserAction())->execute($request->validated());
        NewUserDataJob::dispatch($user);
        NewUserRegistered::dispatch($user);
    return $this->respondOk($user);
    }
# Is a Repository Class Necessary in Laravel?

    In Laravel’s ecosystem, there’s been a consistent debate over the necessity of the Repository pattern, especially when considering Laravel’s unique architecture.
    In the earlier days of Laravel 4 and 5, the Repository pattern was quite the rage. It served as an intermediary layer between Laravel’s Eloquent ORM (Object-Relational Mapping) and the Controller. However, as time progressed and Laravel evolved, this approach became less prevalent.
    To understand this, let’s break down the purpose of the Repository pattern. In general programming, a Repository acts as a bridge between the Controller and the Database. This concept is particularly useful in scenarios where there isn’t an ORM mechanism like Laravel’s Eloquent.
    Laravel’s Eloquent ORM, by design, already functions as this bridge. It provides an abstract layer between the Controller and Database, translating our commands into database queries seamlessly. For instance:
    Instead of directly writing a SQL query like:

    SELECT * FROM USERS;

    With Eloquent, we can simply use:

    User::all();

    Given this, introducing a Repository as an added layer atop Eloquent can be seen as redundant. Essentially, you’d be adding a layer on top of something that already behaves like that layer.
    In conclusion, while the Repository pattern has its merits in specific contexts, in the world of Laravel, it may be an extra layer that doesn’t add significant advantages. It’s always essential to consider the specific needs and structure of your project before deciding on architectural patterns.
    Unlock the power of Domain-Driven Design in Laravel! Start mastering Data Handling, Services, CQRS, and more. Join those who’ve leveled up with our comprehensive eBook!

*/