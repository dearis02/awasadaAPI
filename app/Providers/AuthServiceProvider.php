<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Http\Helpers\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use UnexpectedValueException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt', function (Request $request) {
            $token = $request->bearerToken();

            if (!$token) {
                return null;
            }

            try {
                $decoded = JWT::decode($token);
            } catch (\Exception $e) {
                return null;
            } catch (UnexpectedValueException $e) {
                return null;
            }

            return User::find($decoded->sub);
        });
    }
}
