<?php

$Result1 = ""; //Total Ang Pao
$Result2 = ""; //Remaining Money
$Result3 = "Dragon Bonus not Applied"; //Bonus
$Result4 = "You are Unlucky this Year"; //Lucky Status
$Result5 = ""; //Final Computation
$Error = "";

    if ($_SERVER["REQUEST_METHOD"] == "GET") { //Run the php program
    
        $Zodiac = ["Rat", "Ox", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Rooster", "Dog", "Pig"];
        $Birth = $_GET["birth"]; //Birth date MM/DD/YYYY
        $Angpao1 = $_GET["angpao1"]; //Money
        $Angpao2 = $_GET["angpao2"];
        $Angpao3 = $_GET["angpao3"];
        $Food = $_GET["food"]; //Food expense
        function FindZodiac(){ //Uses the users birthday to 
            global $Zodiac, $Birth;
            $date = new DateTime($Birth); //
            $Birth = $date->format("Y");
            $i = ($Birth - 4 ) % 12;

            if ($i < 0) {
                $i += 12;
            }
            return $Zodiac[$i];
        }
        function LuckyNumber(){ //Generates a number from 1~10
            $Raffle = random_int(1, 10);
            return $Raffle;
        }
        function Calculate(){
            global $Angpao1, $Angpao2, $Angpao3, $Food;
            global $Result1, $Result2, $Result3, $Result4, $Result5;
            
            $Total = $Angpao1 + $Angpao2 + $Angpao3;
            $Result1 = $Total; //Total Angpao
            $Result2 = $Total - $Food; //Angpao - Food expenses

            if(FindZodiac() != "Dragon"){ //Checks if it's not the dragon year
            }else{
                $Total *= 2;
                $Total += 500;
                $Result3 = "Dragon Bonus Applied!"; //Dragon bonus prompt
            }
            
            if(($Total > 5000)& LuckyNumber() == 8 ){
                $Result4 = "You are Lucky this Year"; //Lucky number 8
            }
            $Result5 = $Total; //All bonuses and expenses
        }

        if ($Birth === "" || $Angpao1 === "" || $Angpao2 === "" || $Angpao3 === "" || $Food === "") { //Checks for Null inputs
            $Error = "All fields must be filled";
        }else {
            Calculate()
            $Result1; 
            $Result2;
            $Result3;
            $Result4;
            $Result5;
        }        
    }
?>
