<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Food;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $totalUsers = User::count();
            // $totalOrders = Order::count();
            // $totalRevenue = Order::sum('total_price');
            // $recentOrders = Order::latest()->take(5)->get();

            $totalOrders = 2.355;
            $totalRevenue = 5.2222;
            $recentOrders = 5.22222;

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalOrders',
                'totalRevenue',
                'recentOrders'
            ));
        } catch (\Exception $e) {
            error_log('Error fetching dashboard data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching dashboard data.');
        }
    }

    /**
     * Display the user management page.
     *
     * @return \Illuminate\View\View
     */
    public function userManagement()
    {
        try {
            // Fetch all users (or paginate for better performance)
            $users = User::paginate(10); // Paginate with 10 users per page

            // Fetch total number of users
            $totalUsers = User::count();

            // Fetch total number of orders
            $totalOrders = 5; //------------------------------------->Dummy!
            // Pass users, totalUsers, and totalOrders to the view
            return view('admin.user_management', compact('users', 'totalUsers', 'totalOrders'));
        } catch (\Exception $e) {
            // Debugging: Log the error using error_log()
            error_log('Error fetching users: ' . $e->getMessage());

            // Return a friendly error message
            return redirect()->back()->with('error', 'An error occurred while fetching users.');
        }
    }

    /**
     * Display the order menu.
     *
     * @return \Illuminate\View\View
     */
    public function orderMenu()
    {
        // Dummy data for the food items
        $foods = [
            (object) ['id' => 1, 'name' => 'Burger', 'category' => 'Fast Food', 'price' => 5.99],
            (object) ['id' => 2, 'name' => 'Pizza', 'category' => 'Italian', 'price' => 9.99],
            (object) ['id' => 3, 'name' => 'Pasta', 'category' => 'Italian', 'price' => 7.49],
            (object) ['id' => 4, 'name' => 'Salad', 'category' => 'Vegetarian', 'price' => 4.99],
        ];
    
        return view('admin.order_menu', compact('foods'));
    }
    

    /**
     * Store a new food item.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFood(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            Food::create([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
            ]);

            return redirect()->route('admin.order_menu')->with('success', 'Food item added successfully!');
        } catch (\Exception $e) {
            error_log('Error storing food item: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding the food item.');
        }
    }
}
