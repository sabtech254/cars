<!DOCTYPE html>
<html>
<head>
    <title>New Interest in Your Car</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2d3748;">New Interest in Your Car</h2>
        
        <p>Hello,</p>
        
        <p>Someone is interested in your car listing:</p>
        
        <div style="background: #f7fafc; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3 style="margin: 0 0 10px 0;">Car Details:</h3>
            <p style="margin: 5px 0;"><strong>Title:</strong> {{ $car->title }}</p>
            <p style="margin: 5px 0;"><strong>Price:</strong> ${{ number_format($car->price, 2) }}</p>
            <p style="margin: 5px 0;"><strong>Make:</strong> {{ $car->make }}</p>
            <p style="margin: 5px 0;"><strong>Model:</strong> {{ $car->model }}</p>
            <p style="margin: 5px 0;"><strong>Year:</strong> {{ $car->year }}</p>
        </div>

        <div style="background: #f7fafc; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3 style="margin: 0 0 10px 0;">Buyer Information:</h3>
            <p style="margin: 5px 0;"><strong>Name:</strong> {{ $buyer->name }}</p>
            <p style="margin: 5px 0;"><strong>Email:</strong> {{ $buyer->email }}</p>
            <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $phone }}</p>
        </div>

        <div style="background: #f7fafc; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3 style="margin: 0 0 10px 0;">Message:</h3>
            <p style="margin: 5px 0;">{{ $message }}</p>
        </div>

        <p>You can reply directly to this email to contact the potential buyer.</p>
        
        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 20px 0;">
        
        <p style="color: #718096; font-size: 0.875rem;">
            This email was sent from your car listing on {{ config('app.name') }}.
        </p>
    </div>
</body>
</html>
