/**
 * 音乐上传的js配置文件
 * 采用的plupload上传，插件采用原生js书写
 * 加上jq的$(function(){...})包裹起来是为了实例化多个，给每个实例单独的作用域，防止实例之间参数冲突
 */


$(function () {


accessid= 'sKSFulcGCs7s4U0D';
accesskey= 'JKC0GiJRzHtcAmPH3uCkWnQAIzQUqw';
host = 'https://mevideo.oss-cn-hangzhou.aliyuncs.com';

g_dirname = ''
g_object_name = ''
g_object_name_type = ''
now = timestamp = Date.parse(new Date()) / 1000; 

var policyText = {
    "expiration": "2020-01-01T12:00:00.000Z", //设置该Policy的失效时间，超过这个失效时间之后，就没有办法通过这个policy上传文件了
    "conditions": [
    ["content-length-range", 0, 1048576000] // 设置上传文件的大小限制
    ]
};

var policyBase64 = Base64.encode(JSON.stringify(policyText))
message = policyBase64
var bytes = Crypto.HMAC(Crypto.SHA1, message, accesskey, { asBytes: true }) ;
var signature = Crypto.util.bytesToBase64(bytes);

function check_object_radio() {
	g_object_name_type = 'random_name';//设为随机文件名
}

function get_dirname()
{
	g_dirname = "guangchang/mp3/";
}

function random_string(len) {
　　len = len || 32;
　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';   
　　var maxPos = chars.length;
　　var pwd = '';
　　for (i = 0; i < len; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}

function get_suffix(filename) {
    pos = filename.lastIndexOf('.')
    suffix = ''
    if (pos != -1) {
        suffix = filename.substring(pos)
    }
    return suffix;
}

function calculate_object_name(filename)
{
    if (g_object_name_type == 'local_name')
    {
        g_object_name += "${filename}"
    }
    else if (g_object_name_type == 'random_name')
    {
        suffix = get_suffix(filename)
        g_object_name = g_dirname + random_string(10) + suffix
    }
    return ''
}

function get_uploaded_object_name(filename)
{
    if (g_object_name_type == 'local_name')
    {
        tmp_name = g_object_name
        tmp_name = tmp_name.replace("${filename}", filename);
        return tmp_name
    }
    else if(g_object_name_type == 'random_name')
    {
        return g_object_name
    }
}

function set_upload_param(up, filename, ret)
{
    g_object_name = g_dirname;
    if (filename != '') {
        suffix = get_suffix(filename)
        calculate_object_name(filename)
    }
    new_multipart_params = {
        'key' : g_object_name,
        'policy': policyBase64,
        'OSSAccessKeyId': accessid, 
        'success_action_status' : '200', //让服务端返回200,不然，默认会返回204
        'signature': signature,
    };

    up.setOption({
        'url': host,
        'multipart_params': new_multipart_params
    });

    up.start();
}

var uploaderMusic = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'selectfilesMusic',
    multi_selection: false,//禁止文件多选
	container: document.getElementById('containerMusic'),
	flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
	silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',
    url : 'https://oss.aliyuncs.com',
	filters: {
		mime_types : [ //只允许上传图片和zip文件
			{ title : "Music files", extensions : "mp3" },
		],
		max_file_size : '10000kb', //最大只能上传400kb的文件
		prevent_duplicates : true //不允许选取重复文件
	},
	init: {
		PostInit: function() {
			document.getElementById('ossfileMusic').innerHTML = '';
			document.getElementById('postfilesMusic').onclick = function() {
            set_upload_param(uploaderMusic, '', false);
            return false;
			};
		},

		FilesAdded: function(up, files) {
			//不允许上传第二个视频
			if (uploaderMusic.files.length > 1) {
				alert("只能上传一个文件");
				document.getElementById('ossfileMusic').children[1].remove();

			};
			plupload.each(files, function(file) {
				document.getElementById('ossfileMusic').innerHTML += '<div id="' + file.id +
					'"><div class="flie-name-warp"><div class="file-name">'+ file.name +'(' + plupload.formatSize(file.size) + ')'+
					'</div><div class="progress"><div id="progressBarMusic" class="progress-bar" style="width: 0%"></div></div><b id="videoPrecentMusic"></b></div></div>';
			});
		},

		BeforeUpload: function(up, file) {
            check_object_radio();
            get_dirname();
            set_upload_param(up, file.name, true);
        },

		UploadProgress: function(up, file) {
			var d = document.getElementById(file.id);
			document.getElementById('videoPrecentMusic').innerHTML = file.percent + '%';
			var prog = d.getElementsByTagName('div')[0];
			var progBar = document.getElementById('progressBarMusic');
			progBar.style.width= 2*file.percent+'px';
			progBar.setAttribute('aria-valuenow', file.percent);
			if (file.percent == 100){
				document.getElementById('videoPrecentMusic').innerHTML = '上传完成,请发布!';
			}
			progBar.setAttribute('aria-valuenow', file.percent);
		},

		FileUploaded: function(up, file, info) {
            if (info.status == 200)
            {
//                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = 'upload to oss success, object name:' + get_uploaded_object_name(file.name);
	            document.getElementById('uploadedMusic').value = host + '/' + get_uploaded_object_name(file.name);
            }
            else
            {
//                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
	            document.getElementById('videoPrecentMusic').innerHTML = nfo.response;
            } 
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError xml:" + err.response));
		}
	}
});

uploaderMusic.init();


})