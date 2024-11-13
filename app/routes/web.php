<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publication\PublicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\Email;
use App\Http\Controllers\Reservation\ReservationController;
use App\Http\Controllers\PictureController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    if(Auth::check()){
        return redirect()->route('publications.index');
        
    }
    return view('welcome');
})->name('home')
->middleware(['auth', 'verified']);


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware('guest')->group(function () {

    Route::get('register-type-user', [RegisteredUserController::class, 'registerByTypeUser'])
                ->name('register-type-user');

    Route::get('register/{type}', [RegisteredUserController::class, 'create'])
                ->name('register-type');

    Route::post('register/{type}', [RegisteredUserController::class, 'store'])
                ->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});



Route::get('publications', [PublicationController::class, 'index'])
 ->name('publications.index');
Route::get('publications/fetchList', [PublicationController::class, 'getList'])
 ->name('publications.list');
Route::get('publications/{publication?}', [PublicationController::class, 'show'])
 ->name('publications.show');

Route::middleware('is.owner')->group(function () {
    
    Route::get('publications/addDays', [PublicationController::class, 'getAddDaysForm'])
        ->name('publications.getAddDaysForm');

    Route::post('publications/addDays/{publication}', [PublicationController::class, 'addDays'])
        ->name('publications.addDays');
        
    Route::put('publications/create', [PublicationController::class, 'store'])
        ->name('publications.store');

    Route::post('publications/create/2/{publication_id?}', [PublicationController::class, 'getStep2'])
        ->name('publications.create.2');

        

    Route::get('publications/create/1', [PublicationController::class, 'getStep1'])
        ->name('publications.create.1');
        
    Route::get('publications/edit/list', [PublicationController::class, 'editIndex'])
        ->name('publications.edit.list');

    //This route is used to fetch the data for the edit list
    Route::get('publications/edit/list/fetch', [PublicationController::class, 'editFetch'])->name('publications.edit.fetch');

    Route::match(['get', 'delete'], 'publications/edit/{publication}', [PublicationController::class, 'edit'])
        ->name('publications.edit');

    Route::put('publications/update/{publication}', [PublicationController::class, 'update'])
        ->name('publications.update');

    Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])
            ->name('publications.destroy');
});

Route::get('reservation/create/{reservation}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservation/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::match(['post', 'get'], 'reservation/create', [ReservationController::class, 'preReserve'])->name('reservations.pre-reserve');
Route::get('reservation/show/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('reservation/index/{guest}', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservation/index/owner/{owner}', [ReservationController::class, 'indexOwner'])->name('reservations.index.owner');

Route::delete( 'pictures/{picture}', [PictureController::class, 'destroy'])
    ->name('pictures.destroy');

Route::get('pictures/getHTMLUploadFiles', [PictureController::class, 'getHTMLUploadFiles']);
Route::get('registro',function(){
    Mail::to('nicolas@gmail.com')->send(new Email);

    return "mensaje enviado";

})->name('registro');
