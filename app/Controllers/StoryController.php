<?php

namespace App\Controllers;

use App\Libraries\StoryApiService;

class StoryController extends BaseController
{
    protected $storyApi;

    public function __construct()
    {
        $this->storyApi = new StoryApiService();
    }

    /**
     * Show stories list
     */
    public function index()
    {
        $category = $this->request->getGet('category');

        $stories = $category
            ? $this->storyApi->getStoriesByCategory($category)
            : $this->storyApi->getStories();

        $data = [
            'title' => 'Kisah Islami - Portal Islami',
            'page_title' => 'Kisah Nabi & Sahabat',
            'stories' => $stories,
            'current_category' => $category,
        ];

        return view('story/index', $data);
    }

    /**
     * Show story detail
     */
    public function detail($id)
    {
        $story = $this->storyApi->getStoryDetail($id);

        if (!$story) {
            return redirect()->to('/kisah')->with('error', 'Kisah tidak ditemukan');
        }

        $data = [
            'title' => $story['title'] . ' - Portal Islami',
            'page_title' => $story['title'],
            'story' => $story,
        ];

        return view('story/detail', $data);
    }
}
