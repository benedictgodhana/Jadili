<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import the Africa's Talking PHP SDK to access their services
use AfricasTalking\SDK\AfricasTalking;
use App\Models\Session;
use App\Models\UssdResponse;

class UssdController extends Controller
{
    protected $africasTalking;

    public function __construct()
    {
        // Initialize the AfricasTalking SDK. You will need to run "composer require africastalking/africastalking" to install the Africa's Talking SDK
        $this->africasTalking = new AfricasTalking(
            config('services.africastalking.username'),
            config('services.africastalking.api_key')
        );
    }

    public function handleUssd(Request $request)
    {
        // Get the incoming data from Africa's Talking
        $sessionId = $request->input('sessionId');
        $phoneNumber = $request->input('phoneNumber');
        $text = $request->input('text');

        // Start or retrieve a session for the user
        $session = $this->startOrRetrieveSession($sessionId, $phoneNumber);

        // Process the USSD input
        $responseText = $this->processUssdInput($text);

        // Save the USSD response
        $this->saveUssdResponse($session->id, $responseText);

        // Return the response
        return response($responseText)->header('Content-Type', 'text/plain');
    }

    private function getUserIdByPhoneNumber($phoneNumber)
    {
        // Find the user by phone number
        $user = \App\Models\User::where('phone_number', $phoneNumber)->first();

        if ($user) {
            // Return the existing user's ID
            return $user->id;
        } else {
            // Create a new user with the given phone number
            $newUser = \App\Models\User::create([
                'name' => 'User ' . $phoneNumber, // Default name, customize as needed
                'email' => $phoneNumber . '@example.com', // Placeholder email, customize as needed
                'phone_number' => $phoneNumber,
                'password' => bcrypt('password'), // Default password, set as needed
            ]);

            // Return the new user's ID
            return $newUser->id;
        }
    }

    private function startOrRetrieveSession($sessionId, $phoneNumber)
    {
        $session = Session::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id' => $this->getUserIdByPhoneNumber($phoneNumber)]
        );

        return $session;
    }

    private function processUssdInput($text)
    {
        if ($text === "0") {
            return "CON Welcome to Jadili! Your platform for public engagement.\n1. Feedback on Government Progress\n2. Participate in Public Bill Discussions\n3. Awareness and Accountability";
        } elseif ($text === "1") {
            return "CON You chose Feedback on Government Progress. Please select:\n1. Rate Government Progress\n2. Provide Detailed Feedback";
        } elseif ($text === "1*1") {
            return "CON Rate the government's progress:\n1. Excellent\n2. Good\n3. Fair\n4. Poor";
        } elseif ($text === "1*2") {
            return "CON Please provide your feedback (up to 160 characters):";
        } elseif ($text === "1*1*1") {
            // Handle rating responses and save feedback
            return "END Thank you for rating the government's progress.";
        } elseif ($text === "1*1*2") {
            return "END Thank you for rating the government's progress.";
        } elseif ($text === "1*1*3") {
            return "END Thank you for rating the government's progress.";
        } elseif ($text === "1*1*4") {
            return "END Thank you for rating the government's progress.";
        } elseif (str_starts_with($text, "1*2*")) {
            // Handle detailed feedback
            return "END Thank you for your detailed feedback on government progress.";
        } elseif ($text === "2") {
            return "CON You chose Public Bill Discussions. Please select:\n1. View Current Bills\n2. Provide Comments on Bills";
        } elseif ($text === "2*1") {
            // Fetch and display current bills
            return "END Here are the current bills: [List of Bills].";
        } elseif ($text === "2*2") {
            return "CON Please provide your comments on the bills (up to 160 characters):";
        } elseif (str_starts_with($text, "2*2*")) {
            // Handle comments on bills
            return "END Thank you for your comments on the bills.";
        } elseif ($text === "3") {
            return "CON You chose Awareness and Accountability. Please select:\n1. Report Issues or Concerns\n2. View Recent Updates";
        } elseif ($text === "3*1") {
            return "CON Please report your issue or concern (up to 160 characters):";
        } elseif ($text === "3*2") {
            // Fetch and display recent updates
            return "END Here are the recent updates on government actions: [List of Updates].";
        } else {
            return "END Invalid selection. Please try again.";
        }
    }

    private function saveUssdResponse($sessionId, $responseText)
    {
        // Save the response to the database
        UssdResponse::create([
            'session_id' => $sessionId,
            'response' => $responseText,
        ]);
    }
}
