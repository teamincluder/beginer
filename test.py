import json
class Test:
    def __init__(self):
        self._USER    =   "okkun"
        self._PROJECT =   "includer"
        self._MESSAGE =   "hogehoge"

    def _get_USER(self):
        return self._USER
    def _set_USER(self,name):
        self._USER = name
    def _del_USER(self):
        print("del")

    USER = property(_get_USER,_set_USER,_del_USER)

    def _get_PROJECT(self):
        return self._PROJECT
    def _set_PROJECT(self,project):
        self._PROJECT = project
    def _del_PROJECT(self):
        print("del")

    PROJECT = property(_get_PROJECT,_set_PROJECT,_del_PROJECT)

    def _get_MESSAGE(self):
        return self._MESSAGE
    def _set_MESSAGE(self,MESSAGE):
        self._MESSAGE = MESSAGE
    def _del_MESSAGE(self):
        print("del")

    MESSAGE = property(_get_MESSAGE,_set_MESSAGE,_del_MESSAGE)

    def _get_CHANNEL(self):
        return self._CHANNEL
    def _set_CHANNEL(self,channel):
        self._CHANNEL = channel
    def _del_CHANNEL(self):
        print("del")

    CHANNEL = property(_get_CHANNEL,_set_CHANNEL,_del_CHANNEL)


    def echoJson(self):
        DATA    = {'name':self.USER,'project':self.PROJECT,'message':self.MESSAGE}
        jsonStr = json.dumps(DATA, sort_keys=True, indent=4 , separators=(',', ': '))
        print(jsonStr)

instance = Test()
instance.USER       = "okkun"
instance.MESSAGE    = "hello"
instance.PROJECT    = "game"
instance.echoJson()


instance.USER       = "doberan"
instance.MESSAGE    = "good bye"
instance.PROJECT    = "includer"
instance.echoJson()


instance.USER       = "usikun"
instance.MESSAGE    = "PPAP"
instance.PROJECT    = "hexa"
instance.echoJson()


instance.USER       = "go-chan"
instance.MESSAGE    = "APPP"
instance.PROJECT    = "custom"
instance.echoJson()
