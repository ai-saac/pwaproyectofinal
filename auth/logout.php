<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

/**
 *
 * @author CRISTIAN PAZ
 * @date 1 dic. 2023
 * @time 14:33:56
 */
session_start();

session_unset();

session_destroy();

header("Location: ../index.php");
exit();