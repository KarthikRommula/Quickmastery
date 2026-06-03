<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index1.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index1.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE user_name=?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $uname);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            $stored = $row['password'];

            // Determine whether the stored password is a modern hash or legacy plaintext.
            $info = password_get_info($stored);

            $passwordOk = false;

            $needsUpgrade = false;

            if ($info['algo'] !== 0 && $info['algo'] !== null) {

                // Stored value is a bcrypt/argon hash -> verify it.
                $passwordOk = password_verify($pass, $stored);

            } else {

                // Legacy plaintext password -> compare directly.
                if (hash_equals($stored, $pass)) {

                    $passwordOk = true;

                    $needsUpgrade = true;

                }

            }

            if ($passwordOk && $row['user_name'] === $uname) {

                // Transparently upgrade legacy plaintext passwords to a secure hash.
                if ($needsUpgrade) {

                    $newHash = password_hash($pass, PASSWORD_DEFAULT);

                    $upStmt = mysqli_prepare($conn, "UPDATE users SET password=? WHERE id=?");

                    mysqli_stmt_bind_param($upStmt, "si", $newHash, $row['id']);

                    mysqli_stmt_execute($upStmt);

                    mysqli_stmt_close($upStmt);

                    $row['password'] = $newHash;

                }

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['password'] = $row['password'];

                $_SESSION['id'] = $row['id'];

                header("Location:home.html");

                exit();

            }else{

                header("Location: index1.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: index1.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: index1.php");

    exit();

}