<?php

use Dompdf\Dompdf;
use Dompdf\Options;

if (!function_exists('generateTicketPDF')) {
    function generateTicketPDF($reservation) {
        // Load your HTML template for the ticket
        $html = view('ticket', ['reservation' => $reservation])->render();

        // Setup Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Instantiate Dompdf with options
        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Save the generated PDF to the public folder
        $pdfFileName = 'ticket_' . $reservation->id . '.pdf';
        $pdfFilePath = public_path('tickets/' . $pdfFileName);
        file_put_contents($pdfFilePath, $dompdf->output());

        // Optionally, you can store the file path in the database for future reference
        $reservation->ticket = 'tickets/' . $pdfFileName;
        $reservation->save();

        // Output the generated PDF (you can also save it to a file, or return it as a response)
        // $dompdf->stream('ticket.pdf');
    }
}