<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login_form.php');
}

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:home.php');
}

$sourcePage = isset($_GET['source']) ? $_GET['source'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sourceTable = '';

switch ($sourcePage) {
    case 'activities':
        $sourceTable = 'activities_form';
        $delete_query = mysqli_query($conn, "DELETE FROM `$sourceTable` WHERE id = '$user_id' AND act_id = '$id'") or die('query failed');

        if ($delete_query) {
            header("location: $sourcePage.php");
            exit();
        } else {
            echo 'Delete failed!';
        }
        break;
    case 'certifications':
        $sourceTable = 'certifications_form';
        $delete_query = mysqli_query($conn, "DELETE FROM `$sourceTable` WHERE id = '$user_id' AND cer_id = '$id'") or die('query failed');

        if ($delete_query) {
            header("location: $sourcePage.php");
            exit();
        } else {
            echo 'Delete failed!';
        }
        break;
    case 'competitions':
        $sourceTable = 'competitions_form';
        $delete_query = mysqli_query($conn, "DELETE FROM `$sourceTable` WHERE id = '$user_id' AND comp_id = '$id'") or die('query failed');

        if ($delete_query) {
            header("location: $sourcePage.php");
            exit();
        } else {
            echo 'Delete failed!';
        }
        break;
    case 'challenges':
        $sourceTable = 'challenges_form';
        $delete_query = mysqli_query($conn, "DELETE FROM `$sourceTable` WHERE id = '$user_id' AND cha_id = '$id'") or die('query failed');

        if ($delete_query) {
            header("location: $sourcePage.php");
            exit();
        } else {
            echo 'Delete failed!';
        }
        break;
    default:
        header("location: $sourcePage.php");
        exit();
}
?>
