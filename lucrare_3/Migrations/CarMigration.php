<?php

class CarMigration {
    public function action() {
        $mysql = new mysqli('localhost', 'user','', 'admin');
        $query = [];
        if($mysql) {
            $query[] = "DROP TABLE if exists car";
            $query[] = "Create TABLE if not exists car(id int not null auto_increment, mark varchar(255) not null, an_producere varchar(255), volume varchar(255), parcurs varchar(255), tara varchar(255), pret varchar(255), primary key(id))";
            $query[] = "INSERT into car(mark, an_producere, volume, parcurs, tara, pret) values ('Lada', '2000', '1.4', '0', 'Russia', 'Gratis')";
            $query[] = "INSERT into car(mark, an_producere, volume, parcurs, tara, pret) values ('Mercedez-Benz', '2012', '2.4', '0', 'Germania', '$200 000')";
            $query[] = "INSERT into car(mark, an_producere, volume, parcurs, tara, pret) values ('Tractor', 'Inceputul timpurilor', '10.0', '0', 'Belarus', '$200')";

            foreach($query as $stmt) {
                $mysql->query($stmt);
            }
            $mysql->close();
        }
    }
}