<?php

$arr = json_encode(["Design", "Programming Language: Python","C#", "C# Master"]);

$jobCategory = Yii::$app->db->createCommand("CALL get_insert_jd_parse_skills(:textArray, :creatorId)")
                ->bindValue(':textArray', $arr)->bindValue(':creatorId', $creatorId)->queryAll();
dd($jobCategory);

/*
    DELIMITER $$

    CREATE PROCEDURE get_insert_jd_parse_skills(IN textArray JSON, IN creatorID INT)

    BEGIN
        DECLARE currentText VARCHAR(255);
        DECLARE newId INT;
        DECLARE idx INT DEFAULT 0;
        DECLARE arrayLength INT;

        -- Define the collation used for comparisons
        DECLARE collationName VARCHAR(50) DEFAULT 'utf8mb4_general_ci';  -- Adjust if necessary

        -- Temporary table to store results
        DROP TEMPORARY TABLE IF EXISTS temp_results;
        CREATE TEMPORARY TABLE temp_results (id INT);

        -- Check if the input array is not null
        IF textArray IS NOT NULL THEN
            -- Get the length of the input array
            SET arrayLength = JSON_LENGTH(textArray);

            -- Loop through each text in the array
            WHILE idx < arrayLength DO
                -- Extract current text from the array
                SET currentText = JSON_UNQUOTE(JSON_EXTRACT(textArray, CONCAT('$[', idx, ']')));

                -- Check if the current text already exists, applying the defined collation
                IF EXISTS (SELECT id FROM tbl_my_technical_skill WHERE title = currentText COLLATE utf8mb4_general_ci) THEN
                    -- If it exists, insert the ID into the temporary result table
                    INSERT INTO temp_results (id)
                    SELECT id FROM tbl_my_technical_skill WHERE title = currentText COLLATE utf8mb4_general_ci;
                ELSE
                    -- If it doesn't exist, insert the new text and capture the inserted ID
                    INSERT INTO tbl_my_technical_skill (title, state_id, created_by_id, created_on, updated_on) VALUES (currentText, 1, creatorID,NOW(), NOW());
                    SET newId = LAST_INSERT_ID();

                    -- Insert the new ID into the temporary result table
                    INSERT INTO temp_results (id) VALUES (newId);
                END IF;

                -- Increment the loop index
                SET idx = idx + 1;
            END WHILE;
        END IF;

        -- Return the result as a JSON array of IDs
            SELECT JSON_ARRAYAGG(id) AS result
            FROM temp_results;

        -- Drop the temporary table
        DROP TEMPORARY TABLE IF EXISTS temp_results;

    END$$

    DELIMITER ;
*/