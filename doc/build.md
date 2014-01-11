
### 使用BuilderView BuidlerIndex 时，有些特殊的字段。
 
	uid 管理员ID
	created  创建时间
	updated  更新时间
	vid      多语言需要的唯一ID

### AutoModel 配置


	return array(
		'title'=>array( 
			'type'=>'input', 
			'index'=>true,
			'_value'=>'php:Module_Post_Config::name',
		),
		'body'=>array( 
			'type'=>'text',
			'index'=>true,	
			'widget'=>array(
				'ckeditor'=>array(
					'tag'=>'AutoModel_body'
				)
			),
		),
		'category_id'=>array( 
			'type'=>'select',
			'datas'=>$category,
			'index'=>true,	
			'_value'=>"php:post_config_cateogry"
		),
		'language_id'=>array( 
			'type'=>'select',
			'datas'=>$language,
			'index'=>true,	
			'_value'=>"php:post_config_language"
		),
		//验证规则
		'_rules'=>array( 
		    array('title,body', 'required'), 
		    array('title', 'application.components.validate.unique','table'=>'posts'),	
		),
		//是否顶部显示错误信息
		'_error'=>1,
		//是否是多语言
		'_multiLanguage'=>true,
		'_AutoModel'=>array(
			'AdminUid'	,'Time','Uuid'
		),
		
	);

#### 多语言表一定要有 `language_id` 与 `vid` 这两个字段