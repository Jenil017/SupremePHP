<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Send an order confirmation email.
 *
 * @param array $orderDetails The details of the order.
 * @return bool True if the email was sent successfully, false otherwise.
 */
function sendOrderConfirmationEmail(array $orderDetails): bool
{
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'moradiyajenil528@gmail.com'; // Replace with your Gmail address
        $mail->Password   = 'zpiu ttzd kclz tlzt';       // Replace with your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('no-reply@supremethread.com', 'Supreme Thread');
        $mail->addAddress($orderDetails['email'], $orderDetails['customer_name']);

        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation - #' . $orderDetails['order_id'];
        $mail->Body    = createEmailBody($orderDetails);

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the error for debugging, but don't expose it to the user
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Create the HTML body for the order confirmation email.
 *
 * @param array $orderDetails The details of the order.
 * @return string The HTML email body.
 */
function createEmailBody(array $orderDetails): string
{
    // Sanitize all order details for security
    $orderId = htmlspecialchars((string)($orderDetails['order_id'] ?? 'N/A'));
    $customerName = htmlspecialchars($orderDetails['customer_name'] ?? 'Valued Customer');
    $productName = htmlspecialchars($orderDetails['product_name'] ?? 'N/A');
    $productPrice = htmlspecialchars(number_format((float)($orderDetails['product_price'] ?? 0), 2));
    $quantity = htmlspecialchars((string)($orderDetails['quantity'] ?? 'N/A'));
    $totalPrice = htmlspecialchars(number_format((float)($orderDetails['total_price'] ?? 0), 2));
    $address = htmlspecialchars($orderDetails['address'] ?? 'N/A');

    // Construct the HTML email body using a heredoc for readability
    $htmlBody = <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order Confirmation</title>
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6;">
        <h2>Thank you for your order, {$customerName}!</h2>
        <p>Your order with ID <strong>#{$orderId}</strong> has been successfully placed.</p>
        <h3>Order Summary</h3>
        <div style="margin-bottom: 20px;">
            <table style="border-collapse: collapse; width: 100%;">
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Product</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">{$productName}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Price per Item</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">₹{$productPrice}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Quantity</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">{$quantity}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-weight: bold;">Total Price</td>
                    <td style="padding: 10px; font-weight: bold; text-align: right;">₹{$totalPrice}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <h3>Shipping Address</h3>
            <p>{$address}</p>
            <p>We will notify you once your order is dispatched.</p>
            <p>Best regards,<br>The Supreme Thread Team</p>
        </div>
    </body>
    </html>
HTML;

    return $htmlBody;
}

/**
 * Send an order delivered notification email.
 *
 * @param array $orderDetails The details of the order.
 * @return bool True if the email was sent successfully, false otherwise.
 */
function sendOrderDeliveredEmail(array $orderDetails): bool
{
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'moradiyajenil528@gmail.com'; // Replace with your Gmail address
        $mail->Password   = 'zpiu ttzd kclz tlzt';       // Replace with your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('no-reply@supremethread.com', 'Supreme Thread');
        $mail->addAddress($orderDetails['email'], $orderDetails['customer_name']);

        $mail->isHTML(true);
        $mail->Subject = 'Your Order Has Been Delivered! - #' . $orderDetails['order_id'];
        $mail->Body    = createDeliveredEmailBody($orderDetails);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Create the HTML body for the order delivered email.
 *
 * @param array $orderDetails The details of the order.
 * @return string The HTML email body.
 */
function createDeliveredEmailBody(array $orderDetails): string
{
    $orderId = htmlspecialchars((string)($orderDetails['order_id'] ?? 'N/A'));
    $customerName = htmlspecialchars($orderDetails['customer_name'] ?? 'Valued Customer');
    $productName = htmlspecialchars($orderDetails['product_name'] ?? 'N/A');

    $htmlBody = <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order Delivered</title>
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6;">
        <h2>Great News, {$customerName}!</h2>
        <p>Your order <strong>#{$orderId}</strong> containing <strong>{$productName}</strong> has been delivered.</p>
        <p>We hope you enjoy your purchase!</p>
        <p>Thank you for shopping with us.</p>
        <p>Best regards,<br>The Supreme Thread Team</p>
    </body>
    </html>
HTML;

    return $htmlBody;
}
