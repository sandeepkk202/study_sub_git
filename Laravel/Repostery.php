<?php
/*
    The Repository Pattern is a widely-used software design pattern that separates the application logic from the underlying data storage mechanism. It provides an abstraction layer between the application code and the database, which makes it easier to maintain and test the application. In this article, we will discuss how to implement the Repository Pattern in Laravel.

    Laravel is a popular PHP framework that provides built-in support for the Repository Pattern. The framework provides several features that make it easy to implement the pattern, such as the Eloquent ORM, the Query Builder, and the Dependency Injection container.

    The Repository Pattern in Laravel
    The Repository Pattern in Laravel consists of three main components:

    The Repository Interface: This interface defines the methods that will be used to interact with the data storage mechanism. It provides an abstraction layer between the application code and the database.
    The Repository Class: This class implements the Repository Interface and contains the actual implementation of the methods defined in the interface. It interacts with the data storage mechanism to perform CRUD (Create, Read, Update, and Delete) operations.
    The Service Class: This class uses the Repository Class to perform business logic operations. It acts as an intermediary between the Controller and the Repository, providing a layer of abstraction between the presentation layer and the data storage layer.
    Implementing the Repository Pattern in Laravel
    To implement the Repository Pattern in Laravel, we need to follow these steps:

Step 1: Create a Repository Interface
First, we need to create an interface that defines the methods that will be used to interact with the data storage mechanism. For example, let’s create an interface for a User repository:

<?php

    namespace App\Repositories;

    interface UserRepositoryInterface
    {
        public function all();

        public function create(array $data);

        public function update(array $data, $id);

        public function delete($id);

        public function find($id);
    }
    This interface defines the methods that will be used to perform CRUD operations on the User model.

Step 2: Create a Repository Class
Next, we need to create a Repository class that implements the Repository Interface. This class will interact with the data storage mechanism to perform CRUD operations. For example, let’s create a UserRepository:

<?php

        namespace App\Repositories;

        use App\Models\User;

        class UserRepository implements UserRepositoryInterface
        {
            public function all()
            {
                return User::all();
            }

            public function create(array $data)
            {
            return User::create($data);
        }

        public function update(array $data, $id)
        {
            $user = User::findOrFail($id);
            $user->update($data);
            return $user;
        }

        public function delete($id)
        {
            $user = User::findOrFail($id);
            $user->delete();
        }

        public function find($id)
        {
            return User::findOrFail($id);
        }
    }
    This class implements the methods defined in the UserRepositoryInterface. It interacts with the User model to perform CRUD operations.

Step 3: Create a Service Class
Finally, we need to create a Service class that uses the Repository class to perform business logic operations. For example, let’s create a UserService:

<?php

    namespace App\Services;

    use App\Repositories\UserRepositoryInterface;

    class UserService
    {
        public function __construct(
            protected UserRepositoryInterface $userRepository
        ) {
        }

        public function create(array $data)
        {
            return $this->userRepository->create($data);
        }

        public function update(array $data, $id)
        {
            return $this->userRepository->update($data, $id);
        }

        public function delete($id)
        {
            return $this->userRepository->delete($id)
        }

        public function all()
        {
            return $this->userRepository->all();
        }
        
        public function find($id)
        {
            return $this->userRepository->find($id);
        }
    }
    This class uses the UserRepository to perform CRUD operations on the User model. It acts as an intermediary between the Controller and the Repository, providing a layer of abstraction between the presentation layer and the data storage layer.

Step 4: Register the Service Class in the Service Container
Finally, we need to register the UserService in the Laravel Service Container. This will allow us to use Dependency Injection to inject the UserService into the Controller:

<?php

    namespace App\Providers;

    use App\Repositories\UserRepository;
    use App\Repositories\UserRepositoryInterface;
    use App\Services\UserService;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        public function register()
        {
            $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
            $this->app->bind(UserService::class, function ($app) {
                return new UserService($app->make(UserRepositoryInterface::class));
            });
        }
    }
    This code registers the UserRepositoryInterface and UserRepository classes in the Service Container, and also registers the UserService class, using Dependency Injection to inject the UserRepositoryInterface into the UserService constructor.

Step 5: Use the Service Class in the Controller
Finally, we can use the UserService in the Controller to perform business logic operations. For example, let’s create a UserController:

<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Services\UserService;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        public function __construct(
        protected UserService $userService
        ) {
        }

        public function index()
        {
            $users = $this->userService->all();
            return view('users.index', compact('users'));
        }

        public function create()
        {
            return view('users.create');
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed'
            ]);

            $user = $this->userService->create($data);

            return redirect()->route('users.show', $user->id);
        }

        public function show($id)
        {
            $user = $this->userService->find($id);
            return view('users.show', compact('user'));
        }

        public function edit($id)
        {
            $user = $this->userService->find($id);
            return view('users.edit', compact('user'));
        }

        public function update(Request $request, $id)
        {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$id,
                'password' => 'sometimes|confirmed'
            ]);

            $user = $this->userService->update($data, $id);

            return redirect()->route('users.show', $user->id);
        }

        public function destroy($id)
        {
            $this->userService->delete($id);

            return redirect()->route('users.index');
        }
    }
    This code uses the UserService to perform CRUD operations on the User model. It uses Dependency Injection to inject the UserService into the Controller constructor.

    Conclusion
    To sum up, the Repository Pattern is an advantageous software design pattern that abstracts the communication between application code and the database, simplifying application maintenance and testing. With Laravel’s built-in support, implementing the Repository Pattern is a breeze.
*/