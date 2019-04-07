<?php

class TransactionMigration {
    public function action() {
        $mysql = new mysqli('localhost', 'user','', 'admin');
        $query = [];
        if($mysql) {
            $query[] = "DROP TABLE if exists transaction";
            $query[] = "Create TABLE if not exists transaction(id int not null auto_increment, user_id int not null, car_id int not null, data date, closed int(1), primary key(id), foreign key(car_id) references car(id) on delete cascade, foreign key(user_id) references user(id) on delete cascade)";
            $query[] = "INSERT into transaction(user_id, car_id, data, closed) values (1,1, '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime())) ."', 0)";
            $query[] = "INSERT into transaction(user_id, car_id, data, closed) values (2,1, '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime())) ."', 0)";
            $query[] = "INSERT into transaction(user_id, car_id, data, closed) values (3,2, '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime())) ."', 0)";
            $query[] = "INSERT into transaction(user_id, car_id, data, closed) values (2,1, '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime())) ."', 0)";
            $query[] = "INSERT into transaction(user_id, car_id, data, closed) values (3,3, '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime())) ."', 0)";

            foreach($query as $stmt) {
                $mysql->query($stmt);
            }
            $mysql->close();
        }
    }
}