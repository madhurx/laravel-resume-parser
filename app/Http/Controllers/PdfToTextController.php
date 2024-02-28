<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Smalot\PDFParser;


class PdfToTextController extends Controller
{


    public function con()
    {
        function uploadResume($filePath, $apiKey)
        {
            // Check if file exists
            if (!file_exists($filePath)) {
                return "File not found.";
            }


            // Initialize cURL session
            $curl = curl_init();
            $file_server_path = realpath($filePath);
            $content_type = mime_content_type($file_server_path);
            // dd($content_type);
            // $headers = array(
            //     "Content-Type: $content_type", // or whatever you want
            // );
            $headers = array(
                "Content-Type: application/octet-stream", // or whatever you want
            );
            $filesize = filesize($file_server_path);
            $stream = fopen($file_server_path, 'r');


            // $file = new \CURLFile($file_server_path, 'application/pdf', 'file');
            // dd($file);


            // curl_setopt ($curl, CURLOPT_SAFE_UPLOAD, false);


            // dd($file_server_path);


            // $file = new \CURLFile($filePath,'application/pdf','MyFile');
            // curl_setopt($curl, CURLOPT_POSTFIELDS, ['pdf' => $file]);
            // dd($file);


            // Set cURL options


            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => "https://api.apilayer.com/resume_parser/upload",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => file_get_contents($file_server_path),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/octet-stream",
                        "apikey: $apiKey"
                    ),
                )
            );


            // Execute cURL request and store response
            $response = curl_exec($curl);


            // Check for errors
            if ($response === false) {
                // Handle cURL error
                $error = curl_error($curl);
                return "cURL Error: " . $error;
            }


            // Parse the JSON response
            $responseData = json_decode($response, true);


            // Close cURL session
            curl_close($curl);


            // Check if parsing was successful
            if ($responseData !== null) {
                // Parsing successful, return parsed data
                return $responseData;
            } else {
                // Parsing failed, return error message
                return "Failed to parse JSON response.";
            }
        }


        // $allDetails = [];
        // for ($i = 1; $i < 9; $i++) {
            // Example usage:
            $filePath = public_path("8.pdf");
            $apiKey = 'Q1B6TiWtkZmqOYzDsOGMhoQlRT80UO25';
            $resumeData = uploadResume($filePath, $apiKey);
            $data = json_encode($resumeData, JSON_PRETTY_PRINT);
            $data = json_decode($data, true);
            print_r($data);
            // dd($data);
            // $allDetails[$i] = $data;


        // }
        // dd($allDetails);
    }




    // public function con()
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.apilayer.com/resume_parser/url?url=https://www.resumeviking.com/wp-content/uploads/2022/02/Sydney-Resume-Template-Modern.pdf",
    //         CURLOPT_HTTPHEADER => array(
    //             "Content-Type: text/plain",
    //             "apikey: Q1B6TiWtkZmqOYzDsOGMhoQlRT80UO25"
    //         ),
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET"
    //     )
    //     );

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     dd( $response);
    // }





    //
    // public function con()
    // {
    //     function uploadResume($filePath, $apiKey)
    //     {
    //         // Initialize cURL session
    //         $curl = curl_init();

    //         // Set cURL options
    //         curl_setopt_array(
    //             $curl,
    //             array(
    //                 CURLOPT_URL => "https://api.apilayer.com/resume_parser/upload",
    //                 CURLOPT_RETURNTRANSFER => true,
    //                 CURLOPT_FOLLOWLOCATION => true,
    //                 CURLOPT_MAXREDIRS => 10,
    //                 CURLOPT_TIMEOUT => 0,
    //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                 CURLOPT_CUSTOMREQUEST => "POST",
    //                 CURLOPT_POSTFIELDS => array(
    //                     'resume' => new CURLFile($filePath)
    //                 ),
    //                 CURLOPT_HTTPHEADER => array(
    //                     "Content-Type: application/octet-stream",
    //                     "apikey: $apiKey"
    //                 ),
    //             )
    //         );

    //         // Execute cURL request and store response
    //         $response = curl_exec($curl);

    //         // Check for errors
    //         if ($response === false) {
    //             // Handle cURL error
    //             $error = curl_error($curl);
    //             echo "cURL Error: " . $error;
    //         } else {
    //             // Parse the JSON response
    //             $responseData = json_decode($response, true);

    //             // Check if parsing was successful
    //             if ($responseData !== null) {
    //                 // Parsing successful, return parsed data
    //                 return $responseData;
    //             } else {
    //                 // Parsing failed, return error message
    //                 return "Failed to parse JSON response.";
    //             }
    //         }

    //         // Close cURL session
    //         curl_close($curl);
    //     }
    //     // Example usage:
    //     $filePath = public_path("1.pdf");
    //     $apiKey = 'Q1B6TiWtkZmqOYzDsOGMhoQlRT80UO25';
    //     $resumeData = uploadResume($filePath, $apiKey);
    //     dd(json_encode($resumeData, JSON_PRETTY_PRINT));
    //     echo json_encode($resumeData, JSON_PRETTY_PRINT);
    // }


    // public function uploadResume($filePath, $apiKey)
    // {
    //     // Initialize cURL session
    //     $curl = curl_init();

    //     // Set cURL options
    //     curl_setopt_array(
    //         $curl,
    //         array(
    //             CURLOPT_URL => "https://api.apilayer.com/resume_parser/upload",
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => "POST",
    //             CURLOPT_POSTFIELDS => array(
    //                 'resume' => new CURLFile($filePath)
    //             ),
    //             CURLOPT_HTTPHEADER => array(
    //                 "Content-Type: application/octet-stream",
    //                 "apikey: $apiKey"
    //             ),
    //         )
    //     );

    //     // Execute cURL request and store response
    //     $response = curl_exec($curl);

    //     // Check for errors
    //     if ($response === false) {
    //         // Handle cURL error
    //         $error = curl_error($curl);
    //         echo "cURL Error: " . $error;
    //     } else {
    //         // Parse the JSON response
    //         $responseData = json_decode($response, true);

    //         // Check if parsing was successful
    //         if ($responseData !== null) {
    //             // Parsing successful, return parsed data
    //             return $responseData;
    //         } else {
    //             // Parsing failed, return error message
    //             return "Failed to parse JSON response.";
    //         }
    //     }

    //     // Close cURL session
    //     curl_close($curl);
    // }





    // public function convert()
    // {
    //     $allDetails = [];

    //     $regexName = '/^(.*?)\s+SAP\s*(?:FICO\s*)?CONSULTANT/si';
    //     $regexContactInfo = '/(?:Mobile|Phone|E-mail|Email):\s*([\w\s+@.-]+).*?(?:Address|LinkedIn)?[:\s]*([\w\s,.@()-]+)/si';
    //     $regexObjective = '/OBJECTIVE\s*(.*?)\s*(?:SKILLS|SAP\s*SKILLS\s*&\s*ABILITIES)?/si';
    //     $regexSkills = '/SKILLS\s*(.*?)(?:CERTIFICATION|EXPERIENCE|ACADEMIC\s*HISTORY)?/si';
    //     $regexCertification = '/CERTIFICATION\s*(.*?)(?:EXPERIENCE|ACADEMIC\s*HISTORY)?/si';
    //     $regexExperience = '/EXPERIENCE\s*(.*?)(?:RESPONSIBILITIES|PRODUCTS)?/si';
    //     $regexEducation = '/ACADEMIC\s*HISTORY\s*(.*?)(?:SAP\s*CERTIFICATION|EXPERIENCE)?/si';

    //     for ($i = 1; $i < 9; $i++) {
    //         $pdfFile = public_path($i . ".pdf");

    //         $parser = new \Smalot\PdfParser\Parser();
    //         $pdf = $parser->parseFile($pdfFile);
    //         $text = $pdf->getText();
    //         $lines = explode("\n", $text);

    //         // echo($text);
    //         // die();

    //         $allDetails[$i][0] = $lines;

    //         // dd($lines);

    //         $data = [];
    //         $currentSection = null;
    //         $data['name'] = $lines[0];

    //         foreach ($lines as $line) {
    //             if (empty($line)) {
    //                 continue;
    //             }

    //             // preg_match($regexName, $line, $nameMatches);
    //             // $data['name'] = isset($nameMatches[1]) ? trim($nameMatches[1]) : '';

    //             // preg_match($regexContactInfo, $line, $contactMatches);
    //             // $data['contact'] = isset($contactMatches[1]) ? trim($contactMatches[1]) : '';
    //             // $data['address'] = isset($contactMatches[2]) ? trim($contactMatches[2]) : '';

    //             // preg_match($regexObjective, $line, $objectiveMatches);
    //             // $data['objective'] = isset($objectiveMatches[1]) ? trim($objectiveMatches[1]) : '';

    //             // preg_match($regexSkills, $line, $skillsMatches);
    //             // $data['skills'] = isset($skillsMatches[1]) ? trim($skillsMatches[1]) : '';

    //             // preg_match($regexCertification, $line, $certificationMatches);
    //             // $data['certification'] = isset($certificationMatches[1]) ? trim($certificationMatches[1]) : '';

    //             // preg_match($regexExperience, $line, $experienceMatches);
    //             // $data['experience'] = isset($experienceMatches[1]) ? trim($experienceMatches[1]) : '';

    //             // preg_match($regexEducation, $line, $educationMatches);
    //             // $data['education'] = isset($educationMatches[1]) ? trim($educationMatches[1]) : '';



    //             // if (preg_match($regexName, $line, $nameMatches)) {
    //             //     $data['name'] = isset($nameMatches[1]) ? trim($nameMatches[1]) : '';
    //             // }

    //             // if (preg_match($regexContactInfo, $line, $contactMatches)) {
    //             //     $data['contact'] = isset($contactMatches[1]) ? trim($contactMatches[1]) : '';
    //             //     $data['address'] = isset($contactMatches[2]) ? trim($contactMatches[2]) : '';
    //             // }

    //             // if (preg_match($regexObjective, $line, $objectiveMatches)) {
    //             //     $data['objective'] = isset($objectiveMatches[1]) ? trim($objectiveMatches[1]) : '';
    //             // }

    //             // if (preg_match($regexSkills, $line, $skillsMatches)) {
    //             //     $data['skills'] = isset($skillsMatches[1]) ? trim($skillsMatches[1]) : '';
    //             // }

    //             // if (preg_match($regexCertification, $line, $certificationMatches)) {
    //             //     $data['certification'] = isset($certificationMatches[1]) ? trim($certificationMatches[1]) : '';
    //             // }

    //             // if (preg_match($regexExperience, $line, $experienceMatches)) {
    //             //     $data['experience'] = isset($experienceMatches[1]) ? trim($experienceMatches[1]) : '';
    //             // }

    //             // if (preg_match($regexEducation, $line, $educationMatches)) {
    //             //     $data['education'] = isset($educationMatches[1]) ? trim($educationMatches[1]) : '';
    //             // }

    //             if (preg_match('/^(Name|Full Name|Candidate Name):\s*(.*)/i', $line, $matches)) {
    //                 $data['name'] = trim($matches[2]);
    //             } elseif (preg_match('/\b(Email|E-mail)\b:\s*(.*)/i', $line, $matches)) {
    //                 $data['email'] = trim($matches[2]);
    //             } elseif (preg_match('/\bPhone\b:\s*(.*)/i', $line, $matches)) {
    //                 $data['phone'] = trim($matches[1]);
    //             } elseif (preg_match('/\bExpected\b:.*?(\d{4})/i', $line, $matches)) {
    //                 $data['expected_graduation'] = trim($matches[1]);
    //             } elseif (preg_match('/@/', $line)) {
    //                 $data['email'] = $line;
    //             }




    //             if (preg_match('/^(Education|Experience|Skills|Projects|Activities|Awards|Work Experience|Professional Experience)/i', $line, $matches)) {
    //                 $currentSection = strtolower($matches[1]);
    //                 continue;
    //             }

    //             if (strpos($line, 'Name:') !== false) {
    //                 $data['name'] = trim(str_replace('Name:', '', $line));
    //             } elseif (strpos($line, 'Email:') !== false) {
    //                 $data['email'] = trim(str_replace('Email:', '', $line));
    //             } elseif (strpos($line, 'Phone:') !== false) {
    //                 $data['phone'] = trim(str_replace('Phone:', '', $line));
    //             } elseif (strpos($line, 'Expected:') !== false) {
    //                 $data['expected_graduation'] = trim(str_replace('Expected:', '', $line));
    //             }

    //             if (preg_match('/@/', $line, $email)) {
    //                 $data['email'] = $line;
    //                 continue;
    //             }

    //             if ($currentSection === 'experience' || $currentSection === 'work experience' || $currentSection === 'professional experience') {
    //                 $data['experience'][] = $line;
    //             }
    //             if ($currentSection === 'skills') {
    //                 $data['skills'][] = $line;
    //             }
    //             if ($currentSection === 'projects') {
    //                 $data['projects'][] = $line;
    //             }
    //             if ($currentSection === 'activities') {
    //                 $data['activities'][] = $line;
    //             }

    //         }

    //         $allDetails[$i][1] = $data;
    //         // dd($data);
    //     }
    //     dd($allDetails);
    //     return view('pdfView', compact('text'));
    // }
}
