<?php
use App\Models\Address;
use App\Models\Club;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\PaymentLog;
use App\Models\Product;


if (!function_exists("sendResponse")) {

    function sendResponse($code = 201, $msg = null, $data = null)
    {
        $response = [
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return response()->json($response, $code);
    }

}
if (!function_exists("notFoundResponse")) {

    function notFoundResponse($code = 404, $msg = "not found", $data = null)
    {
        $response = [
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return response()->json($response, $code);
    }

}
if (!function_exists("UploadImage")) {

    function UploadImage($request, $folderName)
    {
        if (!empty($request)) {
            // Create a unique name using the current timestamp and a random string
            $timestamp = time();
            $randomString = Str::random(10); // You can change the length as needed
            $extension = $request->getClientOriginalExtension(); // Get the file extension
            $imageName = $timestamp . '_' . $randomString . '.' . $extension;

            // Store the image in the specified folder in the 'public' disk
            $path = $request->storeAs($folderName, $imageName, 'public');
            return $path;
        }
        return null; // Return null if the request is empty
    }

}
if (!function_exists("UploadImg")) {

    function UploadImg($request, $folderName)
    {
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');

            $uniqueName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

            $path = $imageFile->storeAs($folderName, $uniqueName, 'public');

            return $path;
        }
        return null;
    }

}
if (!function_exists("UploadVideo")) {

    function UploadVideo($request, $folderName)
    {
        if (!empty($request)) {
            $video = uniqid() . '_' . $request->getClientOriginalName();
            $path = $request->storeAs($folderName, $video, 'public');
            return $path;
        }
    }
}

if (!function_exists("UploadMultiImage")) {

    function UploadMultiImage($request, $folderName)
    {
        $paths = [];

        // Check if any files were uploaded
        if ($request) {
            // Get the uploaded files from the request
            $Files = $request;

            // Loop through the uploaded files
            foreach ($Files as $File) {
                // Generate a unique filename for each file
                $filename = uniqid() . '_' . $File->getClientOriginalName();

                // Store the file in the specified folder
                $File->storeAs($folderName, $filename, 'public');

                // Create an array with the path and filename for each file
                $paths[] = [
                    'path' => $folderName . '/' . $filename,
                    // 'filename' => $filename,
                ];
            }
        }
        // Convert the $paths array to JSON format
        $pathFile = json_encode($paths);
        return $pathFile;
    }
}

if (!function_exists("image_url")) {
    function image_url($img, $size = '', $type = '')
    {
        if (str_contains($img, 'http') or str_contains($img, 'https')) {
            return $img;
        }
        if (empty($img) || $img == null) {
            return url('asset/img/avatars/Rectangle.png');
        } else {
            return url('storage/' . $img);
        }

        if (!empty($type)) {
            return (!empty($size)) ? url('/image/' . $size . '/' . $img) . '?type=' . $type : url('/image/' . $img) . '?type=' . $type;
        }

    }
}

if (!function_exists("video_url")) {
    function video_url($video, $size = '', $type = '')
    {
        if (str_contains($video, 'http') or str_contains($video, 'https')) {
            return $video;
        }
        if (empty($video) || $video == null) {
            return url('asset/img/avatars/Rectangle.png');
        } else {
            return url('storage/' . $video);
        }

        if (!empty($type)) {
            return (!empty($size)) ? url('/video/' . $size . '/' . $video) . '?type=' . $type : url('/video/' . $video) . '?type=' . $type;
        }

    }
}

if (!function_exists("isActiveRoute")) {
    function isActiveRoute($routeNames, $activeClass = 'active')
    {
        if (!is_array($routeNames)) {
            $routeNames = [$routeNames];
        }

        foreach ($routeNames as $routeName) {
            if (Route::currentRouteName() === $routeName) {
                return $activeClass;
            }
        }

        return null;
    }

    if (!function_exists('active')) {
        function active($routeName, $parameters = [])
        {
            return request()->routeIs($routeName) && request()->route()->parameters() == $parameters;
        }
    }

    function booking($club_id, $type, $price, $payment_tool, $booking)
    {
        $club=Club::find($club_id);
        $paymentLog = PaymentLog::create([
            'bill_no' => mt_rand(100000000, 9999999999),
            'owner_id' => $club_id,
            'owner_type' => get_class($club),
            'amount' => $price,
            'type' => $type,
            'payment_tool' => $payment_tool,
        ]);

        try {
            $user = auth()->user();
            $items = [
                [
                    "name" => $user->name,
                    "description" => "subscription",
                    "amount" => ($price) * 100,
                    "quantity" => 1,
                ]
            ];

            $billingData = [
                "email" => $user->email,
                "first_name" => $user->name,
                "last_name" => ".",
                "phone_number" => $user->mobile,
                "phone" => $user->mobile,
                "street1" => "",
                "city" => "nan",
                "state" => "nan",
                "country" => "nan",
                "address" => "",
                "floor" => "42",
                "apartment" => "803",
                "street" => "Ethan Land",
                "building" => "8028",
                "shipping_method" => "PKG",
            ];

            $data = [
                "amount" => $price * 100, // Ensure this is an integer value, equivalent to 100.00 SAR
                "currency" => "SAR",
                "payment_methods" => ["MIGS-Website", "Apple Pay - Website"],
                "items" => $items,
                "billing_data" => $billingData,
            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . env("SECRET_KEY")
            ])->post('https://ksa.paymob.com/v1/intention/', $data);

            $paymentToken = $response->object()->client_secret;

        } catch (\Exception $exception) {
            return sendResponse(402, "error", $exception->getMessage());
        }

        return sendResponse(200, 'Subscription successfully', ['url' => 'https://ksa.paymob.com/unifiedcheckout/?publicKey=' . env('PUBLIC_KEY') . '&clientSecret=' . $paymentToken, "paymentLog_id" => $paymentLog->id, "booking_id" => $booking]);
    }

    function payment($type, $payment_tool, $request)
    {

        // Step 2: Get authenticated user
        $user = auth()->user();

        // Step 3: Fetch the address details
        $address = Address::findOrFail($request->address_id);

        // Step 4: Calculate total amount and prepare items array
        $totalAmount = 0;
        $items = [];
        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $amount = $product->price * $item['quantity'];
            $totalAmount += $amount;
            $items[] = [
                "name" => $product->name,
                "description" => $product->description,
                "amount" => $amount * 100, // Amount in cents
                "quantity" => $item['quantity'],
            ];
        }
            // Step 5: Create a PaymentLog entry
            $paymentLog = PaymentLog::create([
                'bill_no' => mt_rand(100000000, 9999999999),
                'owner_id' => $product->owner_id,
                'owner_type' => $product->owner_type,
                'amount' => $product->price * $item['quantity'],
                'type' => $type,
                'payment_tool' => $payment_tool,
            ]);
        try {
            // Step 6: Prepare billing data
            $billingData = [
                "email" => $user->email,
                "first_name" => $user->name,
                "last_name" => ".",
                "phone_number" => $user->mobile,
                "phone" => $user->mobile,
                "street1" => $address->address_line1,
                "street2" => $address->address_line2,
                "city" => $address->city,
                "state" => $address->state,
                "country" => $address->country,
                "postal_code" => $address->postal_code,
                "shipping_method" => "PKG",
            ];

            // Step 7: Prepare data for the payment request
            $data = [
                "amount" => $totalAmount * 100, // Amount in cents
                "currency" => "SAR",
                "payment_methods" => ["MIGS-Website", "Apple Pay - Website"],
                "items" => $items,
                "billing_data" => $billingData,
            ];

            // Step 8: Send the payment request to the payment gateway
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . env("SECRET_KEY")
            ])->post('https://ksa.paymob.com/v1/intention/', $data);

            // Step 9: Extract the payment token from the response
            $paymentToken = $response->object()->client_secret;

            // Step 10: Create an order in the database
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // Step 11: Create order items in the database
            foreach ($request->items as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => Product::findOrFail($item['product_id'])->price,
                ]);
            }

        } catch (\Exception $exception) {
            // Handle exceptions
            return sendResponse(402, "error", $exception->getMessage());
        }

        // Step 12: Return the response with the payment URL and relevant IDs
        return sendResponse(200, 'Subscription successfully', [
            'url' => 'https://ksa.paymob.com/unifiedcheckout/?publicKey=' . env('PUBLIC_KEY') . '&clientSecret=' . $paymentToken,
            "paymentLog_id" => $paymentLog->id,
            "order_id" => $order->id,
        ]);
    }


    function calculateTotalCart()
    {
        $carts=auth()->user()->carts;
        $total=0;
        foreach ($carts as $cart) {
            $total += $cart->price*$cart->quantity;
        }
        return $total;
    }

}








