<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: app/v1alpha/app.proto

namespace GPBMetadata\App\V1Alpha;

class App
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0a9d100a156170702f7631616c7068612f6170702e70726f746f121d7375" .
            "67617263726d2e617069732e69616d2e6170702e7631616c706861227b0a" .
            "1c5265676973746572536572766572536964654170705265717565737412" .
            "0e0a0674656e616e74180120012809122f0a0361707018022001280b3222" .
            "2e737567617263726d2e617069732e69616d2e6170702e7631616c706861" .
            "2e417070121a0a126173736f63696174655f6964656e7469747918032001" .
            "2808225b0a1852656769737465724e617469766541707052657175657374" .
            "120e0a0674656e616e74180120012809122f0a0361707018022001280b32" .
            "222e737567617263726d2e617069732e69616d2e6170702e7631616c7068" .
            "612e41707022430a1055706461746541707052657175657374122f0a0361" .
            "707018012001280b32222e737567617263726d2e617069732e69616d2e61" .
            "70702e7631616c7068612e417070221d0a0d476574417070526571756573" .
            "74120c0a046e616d6518012001280922200a1044656c6574654170705265" .
            "7175657374120c0a046e616d6518012001280922380a0f4c697374417070" .
            "735265717565737412110a09706167655f73697a6518012001280512120a" .
            "0a706167655f746f6b656e180220012809225d0a104c6973744170707352" .
            "6573706f6e736512300a046170707318012003280b32222e737567617263" .
            "726d2e617069732e69616d2e6170702e7631616c7068612e41707012170a" .
            "0f6e6578745f706167655f746f6b656e18022001280922250a15456e6162" .
            "6c654964656e7469747952657175657374120c0a046e616d651801200128" .
            "0922250a1552656d6f76654964656e7469747952657175657374120c0a04" .
            "6e616d6518012001280922270a17526567656e6572617465536563726574" .
            "52657175657374120c0a046e616d65180120012809222a0a18526567656e" .
            "6572617465536563726574526573706f6e7365120e0a0673656372657418" .
            "012001280922b7020a0341707012110a09636c69656e745f696418012001" .
            "280912150a0d636c69656e745f73656372657418022001280912130a0b63" .
            "6c69656e745f6e616d6518032001280912150a0d72656469726563745f75" .
            "72697318042003280912130a0b6772616e745f7479706573180520032809" .
            "12160a0e726573706f6e73655f7479706573180620032809120e0a067363" .
            "6f70657318072003280912100a08636f6e74616374731808200328091210" .
            "0a086c6f676f5f75726918092001280912120a0a636c69656e745f757269" .
            "180a2001280912120a0a706f6c6963795f757269180b20012809120f0a07" .
            "746f735f757269180c2001280912400a106170706c69636174696f6e5f74" .
            "797065180d2001280e32262e737567617263726d2e617069732e69616d2e" .
            "6170702e7631616c7068612e417070547970652a1e0a0741707054797065" .
            "12070a035745421000120a0a064e4154495645100132ab070a0649414d41" .
            "7070127a0a15526567697374657253657276657253696465417070123b2e" .
            "737567617263726d2e617069732e69616d2e6170702e7631616c7068612e" .
            "526567697374657253657276657253696465417070526571756573741a22" .
            "2e737567617263726d2e617069732e69616d2e6170702e7631616c706861" .
            "2e417070220012720a1152656769737465724e617469766541707012372e" .
            "737567617263726d2e617069732e69616d2e6170702e7631616c7068612e" .
            "52656769737465724e6174697665417070526571756573741a222e737567" .
            "617263726d2e617069732e69616d2e6170702e7631616c7068612e417070" .
            "220012620a09557064617465417070122f2e737567617263726d2e617069" .
            "732e69616d2e6170702e7631616c7068612e557064617465417070526571" .
            "756573741a222e737567617263726d2e617069732e69616d2e6170702e76" .
            "31616c7068612e4170702200125c0a06476574417070122c2e7375676172" .
            "63726d2e617069732e69616d2e6170702e7631616c7068612e4765744170" .
            "70526571756573741a222e737567617263726d2e617069732e69616d2e61" .
            "70702e7631616c7068612e417070220012560a0944656c65746541707012" .
            "2f2e737567617263726d2e617069732e69616d2e6170702e7631616c7068" .
            "612e44656c657465417070526571756573741a162e676f6f676c652e7072" .
            "6f746f6275662e456d7074792200126d0a084c69737441707073122e2e73" .
            "7567617263726d2e617069732e69616d2e6170702e7631616c7068612e4c" .
            "69737441707073526571756573741a2f2e737567617263726d2e61706973" .
            "2e69616d2e6170702e7631616c7068612e4c69737441707073526573706f" .
            "6e7365220012640a10526567656e657261746553656372657412362e7375" .
            "67617263726d2e617069732e69616d2e6170702e7631616c7068612e5265" .
            "67656e6572617465536563726574526571756573741a162e676f6f676c65" .
            "2e70726f746f6275662e456d707479220012600a0e456e61626c65496465" .
            "6e7469747912342e737567617263726d2e617069732e69616d2e6170702e" .
            "7631616c7068612e456e61626c654964656e74697479526571756573741a" .
            "162e676f6f676c652e70726f746f6275662e456d707479220012600a0e52" .
            "656d6f76654964656e7469747912342e737567617263726d2e617069732e" .
            "69616d2e6170702e7631616c7068612e52656d6f76654964656e74697479" .
            "526571756573741a162e676f6f676c652e70726f746f6275662e456d7074" .
            "79220042395a376769746875622e636f6d2f737567617263726d2f6d756c" .
            "746976657273652f617069732f69616d2f6170702f7631616c7068613b61" .
            "7070620670726f746f33"
        ));

        static::$is_initialized = true;
    }
}
