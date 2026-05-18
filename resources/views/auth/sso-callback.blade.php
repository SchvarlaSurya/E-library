<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authenticating... — Athena</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#09090b] text-zinc-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center space-y-4">
            <div class="w-8 h-8 border-2 border-zinc-800 border-t-zinc-200 rounded-full animate-spin mx-auto"></div>
            <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-zinc-500">Verifying Session</p>
        </div>
    </div>

    <script>
        window.addEventListener('load', async () => {
            if (window.Clerk) {
                await window.Clerk.load();
            }
        });
    </script>
</body>
</html>