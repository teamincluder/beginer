#!D:\includer\beginer\appTest\Scripts\python.exe
# EASY-INSTALL-ENTRY-SCRIPT: 'test','console_scripts','initialize_test_db'
__requires__ = 'test'
import re
import sys
from pkg_resources import load_entry_point

if __name__ == '__main__':
    sys.argv[0] = re.sub(r'(-script\.pyw?|\.exe)?$', '', sys.argv[0])
    sys.exit(
        load_entry_point('test', 'console_scripts', 'initialize_test_db')()
    )
