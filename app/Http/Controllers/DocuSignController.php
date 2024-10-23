<?php

namespace App\Http\Controllers;

use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\Recipients;
use Illuminate\Http\Request;

class DocuSignController extends Controller
{
    protected $config;
    protected $apiClient;

    public function __construct()
    {
        $this->config = new Configuration();
        $this->config->setHost("https://demo.docusign.net/restapi");
        $this->config->addDefaultHeader("Authorization", "Bearer " . $this->getAccessToken());
        $this->apiClient = new ApiClient($this->config);
    }

    private function getAccessToken()
    {
        // Implement your access token retrieval logic here
        // This might involve using the DocuSign JWT Grant or Authorization Code Grant
    }

    public function createEnvelope(Request $request)
    {
        $envelopeDefinition = new EnvelopeDefinition([
            'email_subject' => "Please sign this document",
            'documents' => [
                new Document([
                    'document_base64' => base64_encode(file_get_contents(public_path('path/to/your/document.pdf'))),
                    'name' => 'Agreement',
                    'file_extension' => 'pdf',
                    'document_id' => '1'
                ])
            ],
            'recipients' => new Recipients([
                'signers' => [
                    new Signer([
                        'email' => $request->input('email'),
                        'name' => $request->input('name'),
                        'recipient_id' => "1",
                        'tabs' => new SignHere([
                            'anchor_string' => '/sn1/',
                            'anchor_units' => 'pixels',
                            'anchor_y_offset' => '10',
                            'anchor_x_offset' => '20'
                        ])
                    ])
                ]
            ]),
            'status' => "sent"
        ]);

        $envelopesApi = new EnvelopesApi($this->apiClient);
        $envelopeSummary = $envelopesApi->createEnvelope(env('DOCUSIGN_ACCOUNT_ID'), $envelopeDefinition);

        return response()->json(['envelope_id' => $envelopeSummary->getEnvelopeId()]);
    }
}

