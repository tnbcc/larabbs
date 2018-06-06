define({ "api": [
  {
    "type": "post",
    "url": "uploadImage",
    "title": "话题图片上传至阿里云OSS[uploadImage]",
    "version": "2.0.0",
    "name": "uploadImage",
    "group": "upload",
    "sampleRequest": [
      {
        "url": "http://www.laraveltalk.top/upload_image"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "date",
            "optional": false,
            "field": "Request",
            "description": "<p>图片上传file信息</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "data",
            "description": "<p>返回数据内容.</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/TopicsController.php",
    "groupTitle": "upload"
  }
] });
