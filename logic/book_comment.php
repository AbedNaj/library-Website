<?php
function commentInsert($pdo , $userID , $bookID){

    if(isset($_POST["comment"])){
        $comment = htmlspecialchars($_POST["comment"]);
      

if($userID){

        try {
            $stmt = $pdo->prepare("INSERT INTO comments (comment, book_ID, user_ID) VALUES (:comment, :bookID, :userID)");
            $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
            $stmt->bindParam(":bookID", $bookID, PDO::PARAM_INT);
            $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
 
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Something went wrong" . $e->getMessage();
        }
    }

    }

}

function fetchComments($pdo , $book_ID) {


    $stmt = $pdo->prepare("SELECT comments.ID as commentID ,  comments.comment ,  comments.comment_date 
    , comments.book_ID , comments.user_ID , users.user_name
     FROM comments

    left join users on users.ID = comments.user_ID 
     WHERE comments.book_ID =  :bookID
     ORDER BY comments.comment_date DESC");
$stmt->bindParam(":bookID", $book_ID, PDO::PARAM_INT);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $result;
}

function commentsCount($pdo , $book_ID) {
    $stmt = $pdo->prepare("SELECT Count(ID) as commentsCount 

     FROM comments

     WHERE book_ID =  :bookID");
$stmt->bindParam(":bookID", $book_ID, PDO::PARAM_INT);
     $stmt->execute();
     $result = $stmt->fetchcolumn();
     return $result;
}

function commentDelete($pdo , $commentID) {
    $stmt = $pdo->prepare("DELETE FROM comments WHERE ID = :commentID");
    $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
    $stmt->execute();
}
?>

