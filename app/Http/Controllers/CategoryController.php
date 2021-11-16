<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Categories', 'List of all categories');
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->listCategories(sort: 'asc');

        $this->setPageTitle('Categories', 'Create Category');
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:191'],
            'parent_id' => ['required', 'not_in:0'],
            'image' => ['mimes:png,jpg,jpeg', 'max:1000'],
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack(
                message: 'Error occured while creating category.',
                type: 'error',
                error: true,
                withOldInputWhenError: true,
            );
        }

        return $this->responseRedirect(
            route: 'admin.categories.index',
            message: 'Category added successfully',
            type: 'success',
        );
    }

    public function edit($id)
    {
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Categories', 'Edit Category: ' . $targetCategory->name);
        return view('admin.categories.edit', compact('categories', 'targetCategory'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:191'],
            'parent_id' => ['required', 'not_in:0'],
            'image' => ['mimes:png,jpg,jpeg', 'max:1000'],
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack(
                message: 'Error occurred while updating category.',
                type: 'error',
                error: true,
                withOldInputWhenError: true,
            );
        }

        return $this->responseRedirectBack(
            message: 'Category updated successfully.',
            type: 'success',
        );
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack(
                message: 'Error occurred while deleting category.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect(
            route: 'admin.categories.index',
            message: 'Category deleted successfully',
            type: 'success',
        );
    }
}
