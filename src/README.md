# MyKirito Proxy Interface - Main Source Codes

我的桐人遊戲代理介面主程式。

## `.code-workspace` 參考設定

```json
{
    "folders": [
        {
            "path": "本專案 src 資料夾的絕對路徑"
        }
    ],
    "settings": {
        "path-intellisense.mappings": {
            "@": "${workspaceFolder}/resources"
        }
    },
    "tasks": {
        "version": "2.0.0",
        "tasks": [
            {
                "label": "PHP CS Fixer",
                "type": "shell",
                "command": "${workspaceFolder}/.php-cs-fix",
                "args": [
                    "${file}"
                ],
                "presentation": {
                    "clear": true,
                    "close": true,
                    "reveal": "silent"
                }
            }
        ]
    }
}
```
