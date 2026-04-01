<?php
session_start();

$reviewsFile = 'product_reviews.json';

// Handle POST request to add a new review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Only logged in users can post
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        echo json_encode(['success' => false, 'message' => 'Not logged in.']);
        exit;
    }

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['productName']) && isset($data['rating']) && isset($data['text'])) {
        $productName = $data['productName'];
        
        $newReview = [
            'author' => '- ' . $_SESSION['user_name'],
            'rating' => (int)$data['rating'],
            'text' => htmlspecialchars($data['text']),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Load existing reviews
        $reviews = [];
        if (file_exists($reviewsFile)) {
            $json = file_get_contents($reviewsFile);
            $reviews = json_decode($json, true) ?: [];
        }

        // Initialize product array if it doesn't exist
        if (!isset($reviews[$productName])) {
            $reviews[$productName] = [];
        }

        // Prepend the new review
        array_unshift($reviews[$productName], $newReview);

        // Save back to file
        file_put_contents($reviewsFile, json_encode($reviews, JSON_PRETTY_PRINT));
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data.']);
    }
    exit;
}

// Handle GET request to fetch reviews for a product
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product'])) {
    $productName = $_GET['product'];
    $reviews = [];
    
    if (file_exists($reviewsFile)) {
        $json = file_get_contents($reviewsFile);
        $allReviews = json_decode($json, true) ?: [];
        if (isset($allReviews[$productName])) {
            $reviews = $allReviews[$productName];
        }
    }
    
    echo json_encode(['success' => true, 'reviews' => $reviews]);
    exit;
}

echo json_encode(['success' => false]);
?>
