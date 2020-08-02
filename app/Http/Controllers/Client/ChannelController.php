<?php

namespace App\Http\Controllers\Client;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Channel;

class ChannelController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Channel';
        $data['contents'] = Channel::all()->where('client_id', Auth::id())->sortByDesc('created_at');

        return view('client.channel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Content';
        return view('client.channel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['page_title'] = 'Content';


        $validationData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'file' => 'required|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:' . config('constants.MAX_FILE_UPLOAD_SIZE'),
                'watermark' => 'required|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:' . config('constants.MAX_FILE_UPLOAD_SIZE'),
                'description' => ['required', 'string'],

            ]
        );
        if ($request->hasfile('file')) {
            $image = $request->file('file');
            $image_name = time() . '_' . $image->getClientOriginalName();
            //$image_path = $request->file('file')->storeAs('uploads', $image_name);
            $image_path = 'channel_banner_images/' . $image_name;
            Storage::disk('s3')->put($image_path, file_get_contents($image));
        }
        if ($request->hasfile('watermark')) {
            $watermark = $request->file('watermark');
            $watermark_name = time() . '_' . $watermark->getClientOriginalName();
            //$image_path = $request->file('file')->storeAs('uploads', $image_name);
            $wartermark_path = 'channel_watermark/' . $watermark_name;
            Storage::disk('s3')->put($wartermark_path, file_get_contents($image));
        }

        $save_data = [
            'name' => $request->name,
            'banner_image' => $image_path,
            'channel_FBpage' => $request->fbpage,
            'channel_Twitterpage' => $request->twitterpage,
            'channel_Instagrampage' => $request->instagrampage,
            'watermark' => $wartermark_path,
            'client_id' => Auth::id(),
            'description' => $request->description,

        ];
        //dd($save_data);
        $content = Channel::create($save_data);
        if ($content) {
            return redirect('client/channel/view/' . $content->id)->with('success', "Channel Added Successfully.");
        } else {
            return redirect('client/channel')->with('failure', "Oops! Channel Not added.");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Update Channel';
        $data['content'] = Channel::findorfail($id);
        return view('client.channel.edit', $data);
    }
    /**
     * Update a created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['page_title'] = 'Update Channel';
        $data['content'] = Channel::findorfail($id);

        $validationData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'file' => 'sometimes|nullable|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:' . config('constants.MAX_FILE_UPLOAD_SIZE'),
                'watermark' => 'sometimes|nullable|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:' . config('constants.MAX_FILE_UPLOAD_SIZE'),
                'description' => ['required', 'string'],

            ]
        );
        if ($request->hasfile('file')) {
            $image = $request->file('file');
            $image_name = time() . '_' . $image->getClientOriginalName();
            //$image_path = $request->file('file')->storeAs('uploads', $image_name);
            $image_path = 'channel_banner_images/' . $image_name;
            Storage::disk('s3')->put($image_path, file_get_contents($image));
        }
        if ($request->hasfile('watermark')) {
            $watermark = $request->file('watermark');
            $watermark_name = time() . '_' . $watermark->getClientOriginalName();
            //$image_path = $request->file('file')->storeAs('uploads', $image_name);
            $wartermark_path = 'channel_watermark/' . $watermark_name;
            Storage::disk('s3')->put($wartermark_path, file_get_contents($image));
        }

        $save_data = [
            'name' => $request->name,
            'channel_FBpage' => $request->fbpage,
            'channel_Twitterpage' => $request->twitterpage,
            'channel_Instagrampage' => $request->instagrampage,
            'client_id' => Auth::id(),
            'description' => $request->description,

        ];
        if (isset($image_path))
            $save_data = array_merge($save_data, ['banner_image' => $image_path]);
        if (isset($wartermark_path))
            $save_data = array_merge($save_data, ['watermark' => $wartermark_path]);
        //dd($save_data);
        $content = Channel::whereId($id)->update($save_data);
        if ($content) {
            return redirect('client/channel/view/')->with('success', "Channel Update Successfully.");
        } else {
            return redirect('client/channel/view/')->with('failure', "Oops! Channel Not Updated.");
        }
    }



    public function view()
    {
        $data['page_title'] = 'Channel Details';
        $data['channel'] = Channel::where('client_id', Auth::id())->first();
        return view('client.channel.view', $data);
    }
}
