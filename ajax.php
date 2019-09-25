<?php
    header("Content-Type: application/json");
    session_start();
    $x = 0;
    $y = 0;
   
    function __autoload($class_name) 
    {
        include $class_name . '.php';
    }
    
  //  print_r($_SESSION["ancient"]);
    
    $x = $_GET["mx"];
    $y = $_GET["my"];
    $test = $_SESSION["chessboard"];
    $tab = array(0);
    //echo "session player".$_SESSION["player"];
    
    
    if (($_SESSION["player"] % 2 == 0))
    {
        if ($test->board[$y][$x]->type != "-")
        {
            $tab = $test->board[$y][$x]->check($x, $y);
        }
        elseif ($test->board[$y][$x]->type == "-" || $test->board[$y][$x]->color == "Black")
        {
            for ($i = 0; $i < sizeof($_SESSION["ancient"]); $i++)
            {
                if ($i % 2 == 0)
                {
                    if ($_SESSION["ancient"][$i] == $x)
                    {
                        if ($_SESSION["ancient"][$i + 1] == $y)
                        {
                            $tab = $test->board[$y][$x]->move($_SESSION["ax"], $_SESSION["ay"], $x, $y);
                            $_SESSION["player"]++;
                            break;
                        }
                    }
                }
                
            }
        }
    }
    elseif (($_SESSION["player"] % 2 == 1))
    {
        if ($test->board[$y][$x]->type != "-")
            {
                $tab = $test->board[$y][$x]->check($x, $y);
            }
        elseif ($test->board[$y][$x]->type == "-" || $test->board[$y][$x]->color == "White")
            {
                for ($i = 0; $i < sizeof($_SESSION["ancient"]); $i++)
                {
                    if ($i % 2 == 0)
                    {
                        if ($_SESSION["ancient"][$i] == $x)
                        {
                            if ($_SESSION["ancient"][$i + 1] == $y)
                            {
                                $tab = $test->board[$y][$x]->move($_SESSION["ax"], $_SESSION["ay"], $x, $y);
                                $_SESSION["player"]++;
                                break;
                            }
                        }
                    }
                
                }
            }
    }
    
    $ancient = $tab;
    $_SESSION["ancient"] = $ancient;
    $_SESSION["ax"] = $x;
    $_SESSION["ay"] = $y;
    $my_encode_array = json_encode($tab);

    echo $my_encode_array;
?>
