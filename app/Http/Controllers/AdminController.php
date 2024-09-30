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

    public function users()
    {
        $users = User::latest()->paginate(10);;
        return view('admin.users', compact('users'));
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

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->photo = $request->photo;
        $data->address = $request->address;
        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' =>  'Admin Frofile Update Succesfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }//End Method

    public function  AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

    }// End Merhod

    public function AdminUpdatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        /// Match teh old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password  Does not Match!',
                'alert-type' => 'error',
            );
            return back()->with($notification);
            /// Update  the New password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            $notification = array(
                'message' => 'Password Change SuccessFully',
                'alert-type' => 'successs',
            );
            return back()->with($notification);
        }
    }
    //end Method

}
