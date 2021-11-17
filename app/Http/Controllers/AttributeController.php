<?php

namespace App\Http\Controllers;

use App\Repositories\AttributeRepository;
use Illuminate\Http\Request;

class AttributeController extends BaseController
{
    protected $attributeRepository;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function index()
    {
        $attributes = $this->attributeRepository->listAttributes();

        $this->setPageTitle('Attributes', 'List of all attributes');
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $this->setPageTitle('Attributes', 'Create Attribute');
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);

        $params = $request->except('_token');

        $attribute = $this->attributeRepository->createAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack(
                message: 'Error occurred while creating attribute.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect(
            route: 'admin.attributes.index',
            message: 'Attribute added successfully',
            type: 'success'
        );
    }

    public function edit($id)
    {
        $attribute = $this->attributeRepository->findAttributeById($id);

        $this->setPageTitle('Attributes', 'Edit Attribute   : ' . $attribute->name);
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);

        $params = $request->except('_token');

        $attribute = $this->attributeRepository->updateAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack(
                message: 'Error occurred while updating attribute.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirectBack(
            message: 'Attribute updated successfully',
            type: 'success'
        );
    }

    public function delete($id)
    {
        $attribute = $this->attributeRepository->deleteAttribute($id);

        if (!$attribute) {
            return $this->responseRedirectBack(
                message: 'Error occurred while deleting attribute.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect(
            route: 'admin.attributes.index',
            message: 'Attribute deleted successfully',
            type: 'success'
        );
    }
}
