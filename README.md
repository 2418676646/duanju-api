# 短剧搜索服务API对接文档

## 概述

本文档提供短剧搜索服务API的对接指南，包括API功能、请求参数、返回数据格式及示例。
本接口主要是用来存储夸克网盘资源然后对接短剧机器人，来实现盈利

## 功能描述

短剧搜索服务API提供短剧名称的搜索功能，用户可通过API提交短剧名称关键字，获取相应的短剧信息列表。

## API请求说明

- **请求URL**：`http://<你的服务器地址>/search.php`
- **请求方式**：GET
- **请求参数**：

| 参数名 | 必选 | 类型   | 说明           |
| :----- | :--- | :----- | :------------- |
| text   | 是   | string | 短剧名称关键字 |

## 返回参数说明

- **返回格式**：JSON
- **返回字段**：

| 字段名    | 类型   | 说明     |
| :-------- | :----- | :------- |
| play_name | string | 短剧名称 |
| play_url  | string | 短剧链接 |

## 请求示例

http

```http
GET http://<你的服务器地址>/search.php?text=悲惨世界
```

## 返回示例

- **成功返回**：

json

```json
[
    {
        "play_name": "悲惨世界",
        "play_url": "http://example.com/lesmiserables"
    },
    // ... 其他匹配的短剧信息
]
```

- **搜索不到结果时返回**：

json

```json
{
    "message": "没有找到剧目"
}
```

- **无效请求时返回**：

json

```json
{
    "message": "无效请求"
}
```

## 错误码

| 错误码 | 说明           |
| :----- | :------------- |
| 200    | 请求成功       |
| 400    | 无效请求       |
| 500    | 服务器内部错误 |

## 补充说明

在使用API之前，请确保数据库和所需的表已经创建，并插入了模拟数据。

### 数据库创建（代码已经实现）

sql

```sql
CREATE DATABASE IF NOT EXISTS your_dbname;
```

### 表创建

sql

```sql
CREATE TABLE IF NOT EXISTS short_plays (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    play_name VARCHAR(30) NOT NULL,
    play_url VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 插入模拟数据

sql

```sql
INSERT INTO short_plays (play_name, play_url) VALUES
('悲惨世界', 'http://example.com/lesmiserables'),
('哈姆雷特', 'http://example.com/hamlet'),
('罗密欧与朱丽叶', 'http://example.com/romeoandjuliet'),
('歌剧魅影', 'http://example.com/phantomoftheopera'),
('西贡小姐', 'http://example.com/missaigon');
```

## 注意事项

- 请替换所有示例中的`<你的服务器地址>`与数据库连接信息为实际使用的地址和凭据。

- 在对数据库进行操作时，请确保遵守相关的安全最佳实践，包括对SQL注入的防护。

  
## 注意事项
- 解析需要注意解析编码问题
- Wecaht：dubear_

## 支持
如在对接过程中遇到任何问题，请联系我
- Wecaht：dubear_ 
- tg：[TG](https://t.me/+qzJ8BZMCbXI1NDg1)



## 其他
- 带后台版本估计3.1号免费开源
- Wecaht：dubear_

  
 ![1.png](https://s2.loli.net/2024/03/29/bUMI691NYCPKcya.png)

