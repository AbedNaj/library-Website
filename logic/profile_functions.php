<?php

function getUserDate($pdo , $user_id){

$stmt = $pdo->prepare("select ID , user_email , user_name
from users
where ID = :user_id");



$stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);
}

function BooksRead($pdo , $user_id){

    $stmt = $pdo->prepare("select count(rent_log.ID) as BooksRead 
from rent_log
join rent on rent_log.rent_ID = rent.ID

where rent.user_ID = :user_id");
    
    
    
    $stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function CurrentlyBorrowedCount($pdo , $user_id){

        $stmt = $pdo->prepare("select count(rent_log.ID) as CurrentlyBorrowed 
    from rent_log
    join rent on rent_log.rent_ID = rent.ID
    
    where rent.user_ID = :user_id and rent_log.return_date is null");
        
        
        
        $stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        function CommentsCount($pdo , $user_id){

$stmt = $pdo->prepare("select count(ID) as commentsCount from comments
where user_ID = :user_id");
            
            $stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
            }

            function CurrentlyBorrowed($pdo , $user_id){

                $stmt = $pdo->prepare("select rent.ID ,
DATEDIFF( rent_log.return_expiry_date,CURRENT_DATE ) as remining_days,
book.book_name,
book_img.img_url,
authors.author_name

from rent
join users on users.ID = rent.user_ID
 join rent_log on rent_log.rent_ID = rent.ID 
join book on book.ID = rent.book_ID
join book_img on book.ID = book_img.book_ID
join authors on book.book_author = authors.ID
where users.ID = :user_id and rent_log.return_date is null");
                
                
                
                $stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
                $stmt->execute();
                
                return $stmt->fetchall(PDO::FETCH_ASSOC);
                }

                function RecentReturn($pdo , $user_id){

                    $stmt = $pdo->prepare("select rent.ID ,
rent_log.return_date,
book.book_name,
book_img.img_url


from rent
join users on users.ID = rent.user_ID
 join rent_log on rent_log.rent_ID = rent.ID 
join book on book.ID = rent.book_ID
join book_img on book.ID = book_img.book_ID

where users.ID = :user_id and rent_log.return_date is not null");
                    
                    
                    
                    $stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
                    $stmt->execute();
                    
                    return $stmt->fetchall(PDO::FETCH_ASSOC);
                    }

?>


