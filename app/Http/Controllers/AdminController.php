<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\Activity;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        try {
            // Get counts for the cards
            $totalCars = Car::count();
            $totalUsers = User::count();
            $totalInquiries = Inquiry::count();
            $totalSales = Car::where('status', 'sold')->count();
            $carsForSale = Car::where('listing_type', 'sale')
                ->where('status', 'available')
                ->count();
            $carsForAuction = Car::where('listing_type', 'auction')
                ->where('status', 'available')
                ->count();
            $activeBids = Bid::where('status', 'active')->count();

            // Get recent cars for sale
            $recentSaleCars = Car::where('listing_type', 'sale')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Get recent cars for auction
            $recentAuctionCars = Car::where('listing_type', 'auction')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Get recent activities
            $recentActivities = Activity::orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            return view('admin.dashboard', compact(
                'totalCars',
                'totalUsers',
                'totalInquiries',
                'totalSales',
                'carsForSale',
                'carsForAuction',
                'activeBids',
                'recentSaleCars',
                'recentAuctionCars',
                'recentActivities'
            ));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in AdminController@index: ' . $e->getMessage());

            // Return view with error handling
            return view('admin.dashboard', [
                'totalCars' => 0,
                'totalUsers' => 0,
                'totalInquiries' => 0,
                'totalSales' => 0,
                'carsForSale' => 0,
                'carsForAuction' => 0,
                'activeBids' => 0,
                'recentSaleCars' => collect([]),
                'recentAuctionCars' => collect([]),
                'recentActivities' => collect([])
            ])->with('error', 'Error loading dashboard data: ' . $e->getMessage());
        }
    }

    /**
     * Display the admin settings page.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        $settings = [
            'site_name' => config('app.name'),
            'contact_email' => config('mail.from.address'),
            'phone_number' => config('app.phone', ''),
            'smtp_host' => config('mail.mailers.smtp.host'),
            'smtp_port' => config('mail.mailers.smtp.port'),
            'smtp_username' => config('mail.mailers.smtp.username'),
            'logo_path' => config('app.logo', ''),
        ];
        
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update the general settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Update .env file
        $this->updateEnvironmentFile([
            'APP_NAME' => $validated['site_name'],
            'MAIL_FROM_ADDRESS' => $validated['contact_email'],
            'APP_PHONE' => $validated['phone_number'],
        ]);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Update the email settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmailSettings(Request $request)
    {
        $validated = $request->validate([
            'smtp_host' => 'required|string|max:255',
            'smtp_port' => 'required|numeric',
            'smtp_username' => 'required|string|max:255',
            'smtp_password' => 'required|string|max:255',
        ]);

        // Update .env file
        $this->updateEnvironmentFile([
            'MAIL_HOST' => $validated['smtp_host'],
            'MAIL_PORT' => $validated['smtp_port'],
            'MAIL_USERNAME' => $validated['smtp_username'],
            'MAIL_PASSWORD' => $validated['smtp_password'],
        ]);

        return redirect()->back()->with('success', 'Email settings updated successfully.');
    }

    /**
     * Update the logo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        try {
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                $oldLogo = config('app.logo');
                if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                    Storage::disk('public')->delete($oldLogo);
                }

                // Store new logo
                $path = $request->file('logo')->store('logos', 'public');
                
                // Update .env file with new logo path
                $this->updateEnvironmentFile([
                    'APP_LOGO' => $path
                ]);

                return redirect()->back()->with('success', 'Logo updated successfully.');
            }

            return redirect()->back()->with('error', 'No logo file provided.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating logo: ' . $e->getMessage());
        }
    }

    /**
     * Update the environment file with new values.
     *
     * @param  array  $values
     * @return void
     */
    private function updateEnvironmentFile($values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                $newLine = "{$envKey}=" . ($envValue ? '"'.$envValue.'"' : '');
                
                if ($keyPosition !== false) {
                    $str = str_replace($oldLine, $newLine, $str);
                } else {
                    $str .= "{$newLine}\n";
                }
            }
        }

        file_put_contents($envFile, $str);
    }
}
