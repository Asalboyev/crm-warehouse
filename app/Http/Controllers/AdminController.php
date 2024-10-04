<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.dashboard');
    }//End Method

    public function AdminLogin()
    {
        return view('admin.login');
    }//End Method

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//End Method

    public function users(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // If the request is AJAX, return only the user list partial view.


        // Otherwise, return the full view.
        return view('admin.users', compact('users', 'search'));
    }


    public function users_create(Request $request)
    {

        // Foydalanuvchi ma'lumotlarini tasdiqlash
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Rasm uchun qo'shimcha validatsiya
        ]);

        // Tasodifiy parol yaratish
//        $password = Str::random(8);

        // Fayl saqlash uchun boshlang'ich yo'l
        $photoPath = null;

        // Agar rasm yuklangan bo'lsa, uni saqlaymiz
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public'); // Storage/public/photos ichiga saqlash
        }

        // Foydalanuvchini yaratish
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']), // Parolni hash qilish
            'photo' => $photoPath, // Rasm yo'lini saqlash (agar yuklangan bo'lsa)
        ]);

        // Foydalanuvchi ma'lumotlarini ko'rsatish
        return redirect()->route('users')->with(['message' => 'Successfully added!']);

    }

    public function users_edit($id)
    {
//    $id = Auth::user()->id;
    $user = User::find($id);
    return view('admin.user-edit',compact('user'));

    }
    public function user_update(Request $request, $id)
    {
        // Foydalanuvchi ma'lumotlarini tasdiqlash
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:20', // Validate role
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Unique check should ignore current user's email
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Rasm uchun qo'shimcha validatsiya
        ]);

        // Foydalanuvchini topish
        $user = User::findOrFail($id);

        // Fayl saqlash uchun boshlang'ich yo'l
        $photoPath = null;

        // Agar rasm yuklangan bo'lsa, uni saqlaymiz
        if ($request->hasFile('photo')) {
            // Eski rasmini o'chirish (agar kerak bo'lsa)
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public'); // Storage/public/photos ichiga saqlash
        }

        // Foydalanuvchini yangilash
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role']; // Assign role from validated data

        // Rasm yo'lini saqlash (agar yuklangan bo'lsa)
        $user->photo = $photoPath ? $photoPath : $user->photo;

        $user->save(); // O'zgarishlarni saqlash

        // Foydalanuvchi ma'lumotlarini ko'rsatish
        return redirect()->back()->with(['message' => 'Successfully updated!']);
    }
    public function user_updatePassword(Request $request, $id)
    {
        // Foydalanuvchi ma'lumotlarini tasdiqlash
        $validatedData = $request->validate([
            'new_password' => 'required|string|min:3|confirmed', // Yangi parolni tasdiqlash
        ]);

        // Foydalanuvchini topish
        $user = User::findOrFail($id);

        // Yangi parolni o'rnatish
        $user->password = Hash::make($validatedData['new_password']); // Parolni hash qilib saqlash
        $user->save(); // O'zgarishlarni saqlash

        // Foydalanuvchi ma'lumotlarini ko'rsatish
        return redirect()->back()->with(['message' => 'Password successfully updated!']);
    }




    //End Method


    public function users_destroy($id)
    {
        // Foydalanuvchini topish
        $user = User::find($id);

        // Agar foydalanuvchi topilmasa, xatolik xabarini ko'rsatish
        if (!$user) {
            return redirect()->back()->with(['error' => 'User not found!']);
        }

        // Foydalanuvchini o'chirish
        $user->delete();

        // O'chirilgandan keyin foydalanuvchini qayta yo'naltirish va xabar ko'rsatish
        return redirect()->back()->with(['message' => 'User successfully deleted!']);
    }


}
