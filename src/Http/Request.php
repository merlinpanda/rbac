<?php

namespace Merlinpanda\Rbac\Http;

use Illuminate\Http\Request as HttpRequest;
use Merlinpanda\Rbac\Models\App;

class Request extends HttpRequest
{
    const APP_KEY_HEADER = "App-Key";

    public function app()
    {
        $app_key = $this->header(self::APP_KEY_HEADER);

        if (!$app_key) {
            return null;
        }

        return App::where([
            'app_key' => $app_key,
            'status' => "NORMAL",
        ])->firstOrFail();
    }
}
