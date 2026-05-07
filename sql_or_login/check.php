<?php
$hack = [
    // ========== SQL关键字 ==========
    'select', 'insert', 'update', 'delete', 'drop', 'alter', 'create', 'truncate',
    'union', 'join', 'from', 'where', 'having', 'group by', 'order by',
    'exec', 'execute', 'declare', 'fetch', 'open', 'close',
    
    // ========== 危险函数 ==========
    'sleep', 'benchmark', 'waitfor', 'delay',
    'load_file', 'outfile', 'dumpfile', 'into outfile', 'into dumpfile',
    'xp_cmdshell', 'sp_executesql', 'sp_prepare',
    'user', 'database', 'version', 'schema', 'information_schema',
    
    // ========== 注释符号（放行 --） ==========
    '/*', '*/', '#',
    
    // ========== 逻辑运算符（只放行or、and） ==========
    ' not ', ' xor ', ' xor(', 'xor(',
    '&&', '||', '!',
    
    // ========== 比较/注入常用 ==========
    '1=2', '1=0', 'true', 'false',
    'like', 'between', 'in(', ' in (',
    'regexp', 'rlike',
    '>', '<', '>=', '<=', '<>', '!=',
    
    // ========== 编码绕过 ==========
    '0x', '0X', 'char(', 'hex(', 'unhex(', 'ascii(', 'ord(',
    'concat(', 'group_concat(', 'substr(', 'substring(', 'mid(',
    'convert(', 'cast(',
    'left(', 'right(',
    
    // ========== 其他 ==========
    'null', 'null%00',
    '\\', '%00', '%09', '%0a', '%0b', '%0c', '%0d', '%a0',
    '/**/', '/*!',
    'if(', 'case ', 'when ',
    'greatest(', 'least(',
    'strcmp',
    'limit ', 'offset ',
    'procedure ',
    'handler ',
    'prepare ',
    'set @',
    'deallocate ',
    'union all',
    'union distinct',
    'select ',
    'select(',
    ' from ',
    ' where ',
    'order ',
    'by ',
    'group ',
    'having ',
    ' into ',
    'collate',
    '"', 
    '`',
    ';',
    '%',
    '+',
    '/',
    '*',
    '^',
    '~',
    '&',
    '|',
    '\\x',
    '\\u',
    '0b',
    '0o',
];

function check($str, $hack_arr) {
    $lower_str = strtolower($str);
    
    foreach ($hack_arr as $keyword) {
        if (strpos($lower_str, strtolower($keyword)) !== false) {
            return false;
        }
    }
    return true;
}
?>