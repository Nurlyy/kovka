<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use PDO;
use PDOException;

class ContactsController extends Controller
{

    public function saveContacts(Request $request)
    {
        // return $request;
        $phone_number = $request->phone_number;
        $email = $request->email;
        $address = $request->address;

        $contact = Contact::findById(1);
        $contact->update([
            'phone_number' => $phone_number,
            'email' => $email,
            'address' => $address
        ]);
        return response()->json(['contacts' => $contact]);
    }

    public function getContacts()
    {
        return response()->json(['contacts' => Contact::all()->first()]);
    }

    public function cve()
    {


        // $envVariable = getenv('DB_HOST');

        // echo $envVariable;
        // echo "<br>";
        // echo getenv("DB_PASSWORD");

        $host = 'mysql';      // Hostname
        $username = 'root';   // Database username
        $password = 'eepoh3mue0gaigaiqu9ahFu8oogie2Za';   // Database password
        $database = 'kovka';   // Database name

        $charset = "utf8mb4";
        $collation = "utf8mb4_unicode_ci";

        // Create a new database connection
        // DB::connection([
        //     'host' => $host,
        //     'username' => $username,
        //     'password' => $password,
        //     'database' => $database,
        // ]);


        // $tableName = 'image';
        // $columnName = 'preview';
        // $columnType = 'TEXT';


        try {
            // Create a new PDO connection
            $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);

            // // Generate the SQL dump file
            //     $dumpFile = str_replace('\\', '/', public_path()) . '/' . 'backup.sql';
            //     $command = "mysqldump --user=$username --password=$password --host=$host $database > $dumpFile";
            //     exec($command);

            //     echo "Database exported successfully.";
            // } catch (PDOException $e) {
            //     echo "Error exporting database: " . $e->getMessage();
            // }






            //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //     // Select all items from the image table
            //     $sql = "SELECT * FROM image";
            //     $stmt = $conn->query($sql);


            //     // Iterate over the rows and update the file extensions
            //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //         $id = $row['id'];
            //         $path = $row['path'];

            //         // Change the file extension (e.g., from .jpg to .png)
            //         $newPath = str_replace('.webp', '-preview.webp', $path);

            //         // Update the 'path' field with the new extension
            //         $updateSql = "UPDATE image SET preview = :newPath WHERE id = :id";
            //         $updateStmt = $conn->prepare($updateSql);
            //         $updateStmt->bindValue(':newPath', $newPath);
            //         $updateStmt->bindValue(':id', $id);
            //         $updateStmt->execute();
            //     }

            //     echo "File extensions updated successfully.";
            // } catch (PDOException $e) {
            //     echo "Error updating file extensions: " . $e->getMessage();
            // }





            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Select all rows from the image table
            // $stmt = 'create table personal (id int not null auto_increment, name VARCHAR(255),
            // position VARCHAR(255),
            // body TEXT,
            // visibility SMALLINT,
            // image VARCHAR(255),
            // email VARCHAR(255), primary key(id));';
            // $conn->exec($stmt);
            // echo "tb created";

// <<<<<<< HEAD
            $conn->exec("ALTER TABLE `page`
            ADD COLUMN `subtitle` TEXT DEFAULT NULL;");
// =======
//             $conn->exec("ALTER TABLE `pages`
//             ADD COLUMN `description1` TEXT,
//             ADD COLUMN `description2` TEXT,
//             ADD COLUMN `description3` TEXT,
//             ADD COLUMN `description4` TEXT,
//             ADD COLUMN `description5` TEXT,
//             ADD COLUMN `description6` TEXT;");
// >>>>>>> c8041094ae916104a885a4a9e155c892c530220e

            // $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // foreach ($contacts as $contact) {
            // var_dump($contact);
            echo "altered";

        } catch (PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }






        // try {
        //     DB::statement("ALTER TABLE `$tableName` ADD `$columnName` $columnType");
        //     echo "Table $tableName altered successfully.";
        // } catch (QueryException $e) {
        //     echo "Error altering table: " . $e->getMessage();
        // }

        // $conn = mysql_connect($host, $username, $password, $database);
        // if (!$conn) {
        //     die('Failed to connect to the database: ' . mysqli_connect_error());
        // }

        // // $sql = "ALTER TABLE `$tableName` ADD `$columnName` $columnType";
        // $sql = "SELECT * FROM contact";

        // var_dump(mysql_query($conn, $sql));

        // DB::statement("ALTER TABLE $tableName ADD $columnName $columnType");

        // if (Schema::hasColumn($tableName, $columnName)) {
        // echo "Column $columnName added successfully to table $tableName";
        // } else {
        // echo "Error adding column";
        // }

    }
}
