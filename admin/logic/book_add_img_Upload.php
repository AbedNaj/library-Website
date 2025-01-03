<?php
include_once "../../constants.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // مسار المجلد الرئيسي الذي سيتم حفظ الصور فيه
    $mainDir = $imgFileLocation; // تأكد من وجود المجلد
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION));

    // التحقق من أن الملف هو صورة
    $check = getimagesize($_FILES["cover"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // التحقق من حجم الملف
    if ($_FILES["cover"]["size"] > 5000000) { // الحجم بالبايت (5 ميغابايت هنا)
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // السماح بأنواع معينة فقط من الملفات
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // التحقق مما إذا كان التحميل مسموحًا
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // جلب بيانات الكتاب المضاف حديثًا
        $stmtLastBook = $pdo->prepare("SELECT ID, book_name FROM book ORDER BY ID DESC LIMIT 1");
        $stmtLastBook->execute();
        $lastBook = $stmtLastBook->fetch(PDO::FETCH_ASSOC);

        if ($lastBook) {
            $bookTitle = $lastBook['book_name'];
            $bookId = $lastBook['ID'];
            $bookTitle = preg_replace('/[^A-Za-z0-9\-]/', '_', $bookTitle);

            // إنشاء مجلد باسم الكتاب داخل img
            $bookDir = $mainDir . "/" . $bookTitle;

            if (!file_exists($bookDir)) {
                mkdir($bookDir, 0777, true); // إنشاء المجلد مع الأذونات
            }

            // تحديد مسار حفظ الصورة داخل مجلد الكتاب
            $targetFile = $bookDir . "/" . basename($_FILES["cover"]["name"]);

            // رفع الملف
            if (move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile)) {
                //  echo "The file " . htmlspecialchars(basename($_FILES["cover"]["name"])) . " has been uploaded.";

                // تخزين مسار الصورة في قاعدة البيانات
                $coverName = $bookTitle . "" . basename($_FILES["cover"]["name"]);
                try {
                    $stmt = $pdo->prepare("INSERT INTO book_img (img_url, book_ID) VALUES (:cover_name, :book_ID)");
                    $stmt->bindParam(":cover_name", $coverName, PDO::PARAM_STR);
                    $stmt->bindParam(":book_ID", $bookId, PDO::PARAM_INT);
                    $successMessage = "Book added successfully!";
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "No book found to associate the image with.";
        }
    }

    header("Location:addBook?success=1&booktitle=" . $bookTitle);
    exit; // إنهاء التنفيذ بعد إعادة التوجيه
}

?>