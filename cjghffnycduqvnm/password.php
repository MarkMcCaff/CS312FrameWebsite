<?php
Function get_password(){
    if (strpos($_SERVER['PHP_SELF'], "~tmb19188/") === 0)
    {
        return "LolXDBro";
    }else {
        die("Access Denied Nerd!");
    }
}