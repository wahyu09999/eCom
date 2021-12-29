<?php

namespace App\Services;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use SimpleXMLElement;

class OracleService
{

    private String $endpoint = 'https://objectstorage.ap-sydney-1.oraclecloud.com/p/6lsWHNQQ2rJ52-T3BJBewLDdxajlOfsB4PzV0drFN5tzo_kivPcHSrm_vWwN0RyL/n/sdjxmkhyhji6/b/bucket-uts/o/';
    private String $access_key = '99a2d044004ff27d383bde3fb28811b2d8d378e5';
    private String $secret_key = 'rUQRf3Sak1b37MhHJn9RRWdHQtfmEiTrYKLyokVd5t4=';
    private String $region = 'ap-sydney-1';


    /**
     * @return [type]
     */
    public function prepare()
    {
        return new S3Client([
            'region'  => $this->region,
            'version' => 'latest',
            'credentials' => [
                'key'    => $this->access_key,
                'secret' => $this->secret_key
            ],
            'bucket_endpoint' => true,
            'endpoint' => $this->endpoint
        ]);
    }

    /**
     * @param mixed $file
     * @param mixed $folder
     *
     * @return [type]
     */
    public function uploadObject($file, $folder)
    {
        try {
            $ext_file = $file->getClientOriginalExtension();
            $key_object = $folder . '_' . time() . '.' . $ext_file;

            $conf = $this->prepare();
            $result = $conf->putObject([
                'Bucket' => $folder,
                'Key' => $key_object,
                'SourceFile' => $file,
                'StorageClass' => 'REDUCED_REDUNDANCY',
            ]);
            $url = $result['ObjectURL'] . PHP_EOL;
            return $url;
        } catch (S3Exception $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }
}
