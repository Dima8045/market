<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use RegistersUsers;

    /**
     * @OA\Post(
     *     path="/register",
     *     operationId="registration",
     *     tags={"Authentication"},
     *     summary="Register",
     *     description="Return created user",
     *     @OA\RequestBody(
     *          request="User",
     *          description="Enter user",
     *          required=true,
     *          @OA\JsonContent(
     *               @OA\Property(
     *                    property="name",
     *                    example="User2",
     *                    type="string",
     *                ),
     *               @OA\Property(
     *                    property="email",
     *                    example="user2@mail.com",
     *                    type="string",
     *                ),
     *                @OA\Property(
     *                    property="password",
     *                    type="string",
     *                    example="123456",
     *               ),
     *                @OA\Property(
     *                    property="password_confirmation",
     *                    type="string",
     *                    example="123456",
     *               ),
     *          )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="The given data was invalid.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                      property="errors",
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(
     *                              property="%FIELD_NAME%",
     *                              type="string"
     *                          )
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="srting"
     *                  )
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="user",
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(
     *                              property="%FIELD_NAME%",
     *                              type="string"
     *                          )
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="access_token",
     *                      type="string",
     *                      default="true",
     *                  ),
     *                  @OA\Property(
     *                      property="redirect",
     *                      type="string"
     *                  ),
     *              ),
     *          )
     *      )
     * )
     */
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $registerData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $registerData['password'] = bcrypt($request->password);

        $user = User::create($registerData);

        $accessToken = $user->createToken('auth')->accessToken;
        $user->access_token = $accessToken;
        return response([
            'user' => $user,
            'redirect' => '/home'
        ]);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="login",
     *     tags={"Authentication"},
     *     summary="Login",
     *     description="Return user",
     *     @OA\RequestBody(
     *          request="User",
     *          description="Enter user",
     *          required=true,
     *          @OA\JsonContent(
     *               @OA\Property(
     *                    property="email",
     *                    example="user1@mail.com",
     *                    type="string",
     *                ),
     *                @OA\Property(
     *                    property="password",
     *                    type="string",
     *                    example="123456",
     *               ),
     *          )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="The given data was invalid.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                      property="errors",
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(
     *                              property="%FIELD_NAME%",
     *                              type="string"
     *                          )
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="srting"
     *                  )
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="user",
     *                      type="object",
     *                      @OA\Items(
     *                          @OA\Property(
     *                              property="%FIELD_NAME%",
     *                              type="string"
     *                          )
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="access_token",
     *                      type="string",
     *                      default="true",
     *                  ),
     *                  @OA\Property(
     *                      property="redirect",
     *                      type="string"
     *                  ),
     *              ),
     *          )
     *      )
     * )
     */
    /**
     * Handle a login request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid credentials']);
        }
        $accessToken = auth()->user()->createToken('auth')->accessToken;
        $user = auth()->user();
        $user->access_token = $accessToken;
        return response([
            'user' => $user,
            'redirect' => '/home'
        ]);

    }

    /**
     * @OA\Get(
     *     path="/logout",
     *     operationId="logout",
     *     tags={"Authentication"},
     *     summary="Logout",
     *     description="Logs out current logged user session",
     *     security={
     *         {"bearerAuth": {}}
     *      },
     *     @OA\Response(
     *         response="401",
     *         description="Access token was invalid.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                      property="message",
     *                      type="string",
     *                  ),
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  ),
     *              ),
     *          )
     *      )
     * )
     */
    /**
     * Handle a logout request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        if ($token->revoke()) {
            return response(['message' => 'You have been succesfully logged out!']);
        }
        return response(['message' => 'Failed to log out']);
    }
}
