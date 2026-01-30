<!DOCTYPE html>
<html>
<head>
    <title>Print Payslip</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>
    <iframe id="payslipFrame" src="{{ route('payslip.view', $id) }}" onload="printIframeContent()"></iframe>

    <script>
        function printIframeContent() {
            const frame = document.getElementById('payslipFrame');
            frame.contentWindow.focus();
            frame.contentWindow.print();
        }

        // Close the window after printing
        window.onafterprint = function() {
            window.close();
        };
    </script>
</body>
</html>
