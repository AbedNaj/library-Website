<?php 
function checkRentCount($pdo, $userID){
      try{
        $userID = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
        $stmt = $pdo->prepare("SELECT Count(rent.ID) as rent_count
          FROM rent
          LEFT JOIN rent_log ON rent_log.rent_ID = rent.ID
          WHERE user_ID = :userID
          AND (rent_state = 1 OR rent_state IS NULL)
          AND rent_log.return_date IS NULL");

$stmt->bindParam(":userID", $userID, PDO::PARAM_INT);

        if($stmt->execute()){
          $rent_count = $stmt->fetchColumn();

          if($rent_count >= 3){
            return false;
          }else{
            return true;}
        }

      }catch(PDOException $e){
        error_log($e->getMessage());
        die("something went wrong...");
      }
    }
    function checkBookRentCount($pdo , $bookID,$userID){
      try{
   
        $stmt = $pdo->prepare("SELECT Count(rent.ID) as rent_count
          FROM rent
          LEFT JOIN rent_log ON rent_log.rent_ID = rent.ID
          WHERE user_ID = :userID
          AND (rent_state = 1 OR rent_state IS NULL)
          AND rent_log.return_date IS NULL AND book_ID = :bookID");

          $stmt->bindParam(":bookID", $bookID, PDO::PARAM_INT);
          $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
        if($stmt->execute()){
          $rent_count = $stmt->fetchColumn();

          if($rent_count >= 1){
            return false;
          }else{
            return true;}
        }

      }catch(PDOException $e){
        error_log($e->getMessage());
        die("something went wrong...");
      }
    }
?>