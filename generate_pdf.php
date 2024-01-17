<?php
require('fpdf.php');

// Check if the user is authenticated using a cookie
if (!isset($_COOKIE['authentificate'])) {
    header("Location: index.php");
    exit;
}

// Start the session
session_start();

$link = mysqli_connect("localhost", "hr", "123", "proiect");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    $sqlUserInfo = "SELECT id, adresa_livrare, adresa_facturare, telefon, data_inregistrare FROM clienti WHERE user_name = '$userID'";
    $resultUserInfo = $link->query($sqlUserInfo);

    if ($resultUserInfo->num_rows > 0) {
        $rowUserInfo = $resultUserInfo->fetch_assoc();
        $adresa_facturare = $rowUserInfo['adresa_facturare'];
        $adresa_livrare = $rowUserInfo['adresa_livrare'];
        $telefon = $rowUserInfo['telefon'];
        $id = $rowUserInfo['id'];
    } else {
        echo "User not found in the database.";
        exit; // Exit the script if the user is not found
    }
} else {
    echo "User not logged in.";
    exit; // Exit the script if the user is not logged in
}

// Fetch orders' total, status, and date
$sqlOrders = "SELECT total, status, data_comenzii FROM comenzi WHERE id_client = $id";
$resultOrders = $link->query($sqlOrders);

if ($resultOrders->num_rows > 0) {
    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Title
    $pdf->Cell(0, 10, 'Order Information', 0, 1, 'C');
    $pdf->Ln(10);

    // Address and Phone
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Delivery Address: ' . $adresa_livrare, 0, 1);
    $pdf->Cell(0, 10, 'Billing Address: ' . $adresa_facturare, 0, 1);
    $pdf->Cell(0, 10, 'Phone: ' . $telefon, 0, 1);
    $pdf->Ln(10);

    // List of Order Information
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'List of Order Information:', 0, 1);
    $pdf->SetFont('Arial', '', 12);

    while ($rowOrder = $resultOrders->fetch_assoc()) {
        $pdf->Cell(0, 10, 'Total: ' . $rowOrder['total'], 0, 1);
        $pdf->Cell(0, 10, 'Status: ' . $rowOrder['status'], 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . $rowOrder['data_comenzii'], 0, 1);
        $pdf->Ln(5); // Add some space between orders
    }

    // Output PDF to the browser
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="generated_pdf.pdf"');
    $pdf->Output();
} else {
    echo "No orders found for the user.";
}

// Close the database connection
$link->close();
?>
