<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentRow;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function storeRow(Request $request)
    {
        if (!$request->id) {
            $documentRow = new DocumentRow();
        } else {

            $documentRow = DocumentRow::firstOrNew(['id' => $request->id]);
        }

        if ($request->document_id) {
            $documentRow->document_id = $request->document_id;
        }

        if ($request->net_price) {
            $documentRow->net_price = $request->net_price;
        }
        if ($request->gross_price) {
            $documentRow->gross_price = $request->gross_price;
        }
        if ($request->pos) {
            $documentRow->pos = $request->pos;
        }
        if ($request->quantity) {
            $documentRow->quantity = $request->quantity;
        }
        if ($request->product && $request->product['id']) {
            $documentRow->product_id = $request->product['id'];
        }
        if ($request->product_name) {
            $documentRow->product_name = $request->product_name;
        }
        if ($request->tax) {
            $documentRow->tax_id = $request->tax['id'];
        }
        $documentRow->save();
        return $request->all();
    }


    public function storeDoc(Request $request)
    {
        if (!$request->id) {
            $document = new Document();
        } else {

            $document = Document::firstOrNew(['id' => $request->id]);
        }


        if ($request->document_date) {
            $document->document_date = $request->document_date;
        }
        if ($request->document_number) {
            $document->document_number = $request->document_number;
        } else {
            $document->document_number = 'draft';
        }

        if ($request->document_status) {
            $document->document_status = $request->document_status;
        }
        if ($request->document_type) {
            $document->document_type = $request->document_type;
        }

        $document->save();
        return $document;
    }

    public function getAllDocuments(Request $request)
    {
        $documents = Document::orderBy('document_date', 'desc')->get();
        return $documents;
    }


    public function getDocumentsById(Request $request, $id)
    {
        $document = Document::where('id', $id)->first();
        // $document = Document::where('id', $id)->with('documentRows')->first();
        return $document;
    }
    public function getDocumentRowsByDocumentId(Request $request, $id)
    {
        $documentRows = DocumentRow::where('document_id', $id)->with('tax')->orderBy('pos', 'asc')->get();
        // $document = Document::where('id', $id)->with('documentRows')->first();
        return $documentRows;
    }

    public function deleteDoc(Request $request, $id)
    {
        $documentRows = DocumentRow::where('document_id', $id)->delete();
        $document = Document::where('id', $id)->delete();
        // $document = Document::where('id', $id)->with('documentRows')->first();

        return [$documentRows, $document];
    }
}
