<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: provider/v1alpha/provider.proto

namespace GPBMetadata\Provider\V1Alpha;

class Provider
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        \GPBMetadata\Google\Protobuf\Duration::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0af4230a1f70726f76696465722f7631616c7068612f70726f7669646572" .
            "2e70726f746f1222737567617263726d2e617069732e69616d2e70726f76" .
            "696465722e7631616c7068611a1e676f6f676c652f70726f746f6275662f" .
            "6475726174696f6e2e70726f746f1a1c676f6f676c652f6170692f616e6e" .
            "6f746174696f6e732e70726f746f22640a1d436f6e6669677572654c6f63" .
            "616c50726f76696465725265717565737412430a0870726f766964657218" .
            "012001280b32312e737567617263726d2e617069732e69616d2e70726f76" .
            "696465722e7631616c7068612e4c6f63616c50726f766964657222270a17" .
            "4765744c6f63616c50726f766964657252657175657374120c0a046e616d" .
            "6518012001280922620a1c436f6e6669677572654c64617050726f766964" .
            "65725265717565737412420a0870726f766964657218012001280b32302e" .
            "737567617263726d2e617069732e69616d2e70726f76696465722e763161" .
            "6c7068612e4c64617050726f766964657222260a164765744c6461705072" .
            "6f766964657252657175657374120c0a046e616d6518012001280922290a" .
            "1944656c6574654c64617050726f766964657252657175657374120c0a04" .
            "6e616d6518012001280922620a1c436f6e66696775726553616d6c50726f" .
            "76696465725265717565737412420a0870726f766964657218012001280b" .
            "32302e737567617263726d2e617069732e69616d2e70726f76696465722e" .
            "7631616c7068612e53616d6c50726f766964657222260a1647657453616d" .
            "6c50726f766964657252657175657374120c0a046e616d65180120012809" .
            "22290a1944656c65746553616d6c50726f76696465725265717565737412" .
            "0c0a046e616d65180120012809225e0a0d4c6f63616c50726f7669646572" .
            "120c0a046e616d65180120012809123f0a06636f6e66696718022001280b" .
            "322f2e737567617263726d2e617069732e69616d2e70726f76696465722e" .
            "7631616c7068612e4c6f63616c436f6e66696722dc020a0b4c6f63616c43" .
            "6f6e66696712570a1570617373776f72645f726571756972656d656e7473" .
            "18012001280b32382e737567617263726d2e617069732e69616d2e70726f" .
            "76696465722e7631616c7068612e50617373776f7264526571756972656d" .
            "656e747312560a1570617373776f72645f72657365745f706f6c69637918" .
            "022001280b32372e737567617263726d2e617069732e69616d2e70726f76" .
            "696465722e7631616c7068612e50617373776f72645265736574506f6c69" .
            "637912530a1370617373776f72645f65787069726174696f6e1803200128" .
            "0b32362e737567617263726d2e617069732e69616d2e70726f7669646572" .
            "2e7631616c7068612e50617373776f726445787069726174696f6e12470a" .
            "0d6c6f67696e5f6c6f636b6f757418042001280b32302e73756761726372" .
            "6d2e617069732e69616d2e70726f76696465722e7631616c7068612e4c6f" .
            "67696e4c6f636b6f757422d8010a1450617373776f726452657175697265" .
            "6d656e747312160a0e6d696e696d756d5f6c656e67746818012001280d12" .
            "160a0e6d6178696d756d5f6c656e67746818022001280d12150a0d726571" .
            "756972655f757070657218032001280812150a0d726571756972655f6c6f" .
            "77657218042001280812160a0e726571756972655f6e756d626572180520" .
            "01280812170a0f726571756972655f7370656369616c1806200128081216" .
            "0a0e70617373776f72645f726567657818072001280912190a1172656765" .
            "785f6465736372697074696f6e1808200128092289010a1350617373776f" .
            "72645265736574506f6c696379120e0a06656e61626c6518012001280812" .
            "2d0a0a65787069726174696f6e18022001280b32192e676f6f676c652e70" .
            "726f746f6275662e4475726174696f6e12190a11726571756972655f7265" .
            "6361707463686118032001280812180a10726571756972655f686f6e6579" .
            "706f74180620012808224e0a1250617373776f726445787069726174696f" .
            "6e12270a0474696d6518012001280b32192e676f6f676c652e70726f746f" .
            "6275662e4475726174696f6e120f0a07617474656d707418022001280d22" .
            "bc010a0c4c6f67696e4c6f636b6f757412430a047479706518012001280e" .
            "32352e737567617263726d2e617069732e69616d2e70726f76696465722e" .
            "7631616c7068612e4c6f67696e4c6f636b6f75742e54797065120f0a0761" .
            "7474656d707418022001280d12270a0474696d6518032001280b32192e67" .
            "6f6f676c652e70726f746f6275662e4475726174696f6e222d0a04547970" .
            "65120c0a0844495341424c45441000120d0a095045524d414e454e541001" .
            "12080a0454494d45100222a9010a0c4c64617050726f7669646572120c0a" .
            "046e616d65180120012809123e0a06636f6e66696718022001280b322e2e" .
            "737567617263726d2e617069732e69616d2e70726f76696465722e763161" .
            "6c7068612e4c646170436f6e666967124b0a116174747269627574655f6d" .
            "617070696e6718032003280b32302e737567617263726d2e617069732e69" .
            "616d2e70726f76696465722e7631616c7068612e4174747269627574654d" .
            "617022f8020a0a4c646170436f6e66696712190a116175746f5f63726561" .
            "74655f7573657273180120012808120e0a06736572766572180220012809" .
            "120f0a07757365725f646e18032001280912130a0b757365725f66696c74" .
            "657218042001280912160a0e62696e645f61747472696275746518052001" .
            "280912170a0f6c6f67696e5f61747472696275746518062001280912160a" .
            "0e61757468656e7469636174696f6e180720012808121e0a166175746865" .
            "6e7469636174696f6e5f757365725f646e180820012809121f0a17617574" .
            "68656e7469636174696f6e5f70617373776f726418092001280912180a10" .
            "67726f75705f6d656d62657273686970180a2001280812100a0867726f75" .
            "705f646e180b2001280912120a0a67726f75705f6e616d65180c20012809" .
            "12170a0f67726f75705f617474726962757465180d20012809121d0a1575" .
            "7365725f756e697175655f617474726962757465180e2001280912170a0f" .
            "696e636c7564655f757365725f646e180f2001280822a9010a0c53616d6c" .
            "50726f7669646572120c0a046e616d65180120012809123e0a06636f6e66" .
            "696718022001280b322e2e737567617263726d2e617069732e69616d2e70" .
            "726f76696465722e7631616c7068612e53616d6c436f6e666967124b0a11" .
            "6174747269627574655f6d617070696e6718032003280b32302e73756761" .
            "7263726d2e617069732e69616d2e70726f76696465722e7631616c706861" .
            "2e4174747269627574654d617022c5030a0a53616d6c436f6e6669671213" .
            "0a0b6964705f73736f5f75726c18012001280912130a0b6964705f736c6f" .
            "5f75726c18022001280912150a0d6964705f656e746974795f6964180320" .
            "01280912140a0c73705f656e746974795f696418042001280912110a0978" .
            "3530395f6365727418052001280912160a0e70726f766973696f6e5f7573" .
            "657218062001280812130a0b73616d655f77696e646f7718072001280812" .
            "1c0a14726571756573745f7369676e696e675f706b657918082001280912" .
            "1c0a14726571756573745f7369676e696e675f6365727418092001280912" .
            "5c0a16726571756573745f7369676e696e675f6d6574686f64180a200128" .
            "0e323c2e737567617263726d2e617069732e69616d2e70726f7669646572" .
            "2e7631616c7068612e53616d6c436f6e6669672e5369676e696e674d6574" .
            "686f64121a0a127369676e5f617574686e5f72657175657374180b200128" .
            "08121b0a137369676e5f6c6f676f75745f72657175657374180c20012808" .
            "121c0a147369676e5f6c6f676f75745f726573706f6e7365180d20012808" .
            "222f0a0d5369676e696e674d6574686f64120e0a0a5253415f5348413235" .
            "361000120e0a0a5253415f534841353132100122460a0c41747472696275" .
            "74654d6170120e0a06736f7572636518012001280912130a0b6465737469" .
            "6e6174696f6e18022001280912110a096f76657277726974651803200128" .
            "08328c0c0a0b50726f766964657241504912ea010a16436f6e6669677572" .
            "654c6f63616c50726f766964657212412e737567617263726d2e61706973" .
            "2e69616d2e70726f76696465722e7631616c7068612e436f6e6669677572" .
            "654c6f63616c50726f7669646572526571756573741a312e737567617263" .
            "726d2e617069732e69616d2e70726f76696465722e7631616c7068612e4c" .
            "6f63616c50726f7669646572225a82d3e4930254221c2f7631616c706861" .
            "2f69616d2f70726f7669646572732f6c6f63616c3a012a5a311a2c2f7631" .
            "616c7068612f69616d2f70726f7669646572732f6c6f63616c2f7b70726f" .
            "76696465722e6e616d657d3a012a12af010a104765744c6f63616c50726f" .
            "7669646572123b2e737567617263726d2e617069732e69616d2e70726f76" .
            "696465722e7631616c7068612e4765744c6f63616c50726f766964657252" .
            "6571756573741a312e737567617263726d2e617069732e69616d2e70726f" .
            "76696465722e7631616c7068612e4c6f63616c50726f7669646572222b82" .
            "d3e493022512232f7631616c7068612f69616d2f70726f7669646572732f" .
            "6c6f63616c2f7b6e616d657d12e5010a15436f6e6669677572654c646170" .
            "50726f766964657212402e737567617263726d2e617069732e69616d2e70" .
            "726f76696465722e7631616c7068612e436f6e6669677572654c64617050" .
            "726f7669646572526571756573741a302e737567617263726d2e61706973" .
            "2e69616d2e70726f76696465722e7631616c7068612e4c64617050726f76" .
            "69646572225882d3e4930252221b2f7631616c7068612f69616d2f70726f" .
            "7669646572732f6c6461703a012a5a301a2b2f7631616c7068612f69616d" .
            "2f70726f7669646572732f6c6461702f7b70726f76696465722e6e616d65" .
            "7d3a012a12ab010a0f4765744c64617050726f7669646572123a2e737567" .
            "617263726d2e617069732e69616d2e70726f76696465722e7631616c7068" .
            "612e4765744c64617050726f7669646572526571756573741a302e737567" .
            "617263726d2e617069732e69616d2e70726f76696465722e7631616c7068" .
            "612e4c64617050726f7669646572222a82d3e493022412222f7631616c70" .
            "68612f69616d2f70726f7669646572732f6c6461702f7b6e616d657d1297" .
            "010a1244656c6574654c64617050726f7669646572123d2e737567617263" .
            "726d2e617069732e69616d2e70726f76696465722e7631616c7068612e44" .
            "656c6574654c64617050726f7669646572526571756573741a162e676f6f" .
            "676c652e70726f746f6275662e456d707479222a82d3e49302242a222f76" .
            "31616c7068612f69616d2f70726f7669646572732f6c6461702f7b6e616d" .
            "657d12e5010a15436f6e66696775726553616d6c50726f76696465721240" .
            "2e737567617263726d2e617069732e69616d2e70726f76696465722e7631" .
            "616c7068612e436f6e66696775726553616d6c50726f7669646572526571" .
            "756573741a302e737567617263726d2e617069732e69616d2e70726f7669" .
            "6465722e7631616c7068612e53616d6c50726f7669646572225882d3e493" .
            "0252221b2f7631616c7068612f69616d2f70726f7669646572732f73616d" .
            "6c3a012a5a301a2b2f7631616c7068612f69616d2f70726f766964657273" .
            "2f73616d6c2f7b70726f76696465722e6e616d657d3a012a12ab010a0f47" .
            "657453616d6c50726f7669646572123a2e737567617263726d2e61706973" .
            "2e69616d2e70726f76696465722e7631616c7068612e47657453616d6c50" .
            "726f7669646572526571756573741a302e737567617263726d2e61706973" .
            "2e69616d2e70726f76696465722e7631616c7068612e53616d6c50726f76" .
            "69646572222a82d3e493022412222f7631616c7068612f69616d2f70726f" .
            "7669646572732f73616d6c2f7b6e616d657d1297010a1244656c65746553" .
            "616d6c50726f7669646572123d2e737567617263726d2e617069732e6961" .
            "6d2e70726f76696465722e7631616c7068612e44656c65746553616d6c50" .
            "726f7669646572526571756573741a162e676f6f676c652e70726f746f62" .
            "75662e456d707479222a82d3e49302242a222f7631616c7068612f69616d" .
            "2f70726f7669646572732f73616d6c2f7b6e616d657d42435a4167697468" .
            "75622e636f6d2f737567617263726d2f6d756c746976657273652f617069" .
            "732f69616d2f70726f76696465722f7631616c7068613b70726f76696465" .
            "72620670726f746f33"
        ));

        static::$is_initialized = true;
    }
}

