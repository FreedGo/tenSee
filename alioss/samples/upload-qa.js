//accessid= 'sKSFulcGCs7s4U0D';
//accesskey= 'JKC0GiJRzHtcAmPH3uCkWnQAIzQUqw';
//host = 'http://mevideo.oss-cn-hangzhou.aliyuncs.com';


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
    var tt = document.getElementsByName('myradio');
    for (var i = 0; i < tt.length ; i++ )
    {
        if(tt[i].checked)
        {
            g_object_name_type = tt[i].value;
            break;
        }
    }
}

function get_dirname()
{
    dir = document.getElementById("dirname").value;
    if (dir != '' && dir.indexOf('/') != dir.length - 1)
    {
	    g_dirname = "video/";
    }
    //alert(dir)
    g_dirname = dir
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
        g_object_name = g_dirname + random_string(32) + suffix
    }

    return '';
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


function set_video_zhuanma(up, filename, ret)
{


    params = {
        'filepath' : filename,
		'videofile' : videofile
    };

    up.setOption({
        'url': '/e/extend/alioss/samples/zhuanma.php',
        'multipart_params': params
    });

    up.start();
}


var xmlHttp;

function video_zhuanma(filepath,videofile)
{

   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
  {
    alert ("Browser does not support HTTP Request")
    return
  }
    //此处调用转码的 php文件
	var url="/e/extend/alioss/samples/zhuanma.php"
	url=url+"?filepath="+filepath
	url=url+"&filename="+videofile
	xmlHttp.onreadystatechange=stateChanged
	console.log(url);
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
} 

function stateChanged() 
{ 
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
//   document.getElementById("zhuanma").innerHTML=xmlHttp.responseText
 } 
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
 catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
 return xmlHttp;
}

var uploaderVideo = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'selectfiles', 
    multi_selection: false,//不允许多选文件
	container: document.getElementById('container'),
	flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
	silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',
    url : 'https://oss.aliyuncs.com',
	filters: {
		mime_types : [ //只允许上传图片和zip文件
			{ title : "Video files", extensions : "mp4,avi,mov,3gp,mkv,rmvb,flv" }
		],
		max_file_size : '500000kb', //最大只能上传500mb的文件
		prevent_duplicates : true //不允许选取重复文件
	},
	init: {
		PostInit: function() {
			document.getElementById('ossfile').innerHTML = '';
			document.getElementById('postfiles').onclick = function() {
            set_upload_param(uploaderVideo, '', false);
            return false;
			};
		},

		FilesAdded: function(up, files) {
			//不允许上传第二个视频
			if (uploaderVideo.files.length > 1) {
				alert("只能上传一个文件");
				document.getElementById('ossfile').children[1].remove();

			};
			plupload.each(files, function(file) {
				document.getElementById('ossfile').innerHTML += '<div id="' + file.id +
					'"><div class="flie-name-warp"><div class="file-name">'+ file.name +'(' + plupload.formatSize(file.size) + ')'+
					'</div><div class="progress"><div id="progressBar" class="progress-bar" style="width: 0%"></div></div><b id="videoPrecent"></b></div></div>';
			});
		},


		BeforeUpload: function(up, file) {
            check_object_radio();
            get_dirname();
            set_upload_param(up, file.name, true);
        },

		UploadProgress: function(up, file) {
			var d = document.getElementById(file.id);
//			d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			document.getElementById('videoPrecent').innerHTML = file.percent + '%';
            var prog = d.getElementsByTagName('div')[0];
			var progBar = document.getElementById('progressBar');
			progBar.style.width= 2*file.percent+'px';
			progBar.setAttribute('aria-valuenow', file.percent);
			if (file.percent == 100){
				document.getElementById('videoPrecent').innerHTML = '上传完成,请发布!';
			}
		},

		FileUploaded: function(up, file, info) {
			console.log(file);
            if (info.status == 200)
            {
                filename = get_uploaded_object_name(file.name);
//				console.log(filename);
//				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '上传成功, <br />视频网址:' + host+"/"+ filename;
//				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '视频上传成功, <br />视频转码后的网址'+ host+ '/transcode/'+videofile+'.mp4 <br />截图网址'+ host+'/snapshots/'+videofile+'.jpg';

//				document.getElementById("zhuanma").innerHTML='<b style="color:#F00">服务器处理转码中...</b>';
	            document.getElementById('titlepic').value = host + '/snapshots/'+videofile+'.jpg';
	            document.getElementById('downpath1').value = host + '/transcode/'+videofile+'.mp4';
				video_zhuanma(filename,videofile);
				
            }
            else
            {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
            } 
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError xml:" + err.response));
		}
	}
});

uploaderVideo.init();