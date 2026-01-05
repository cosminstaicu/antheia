Any css definition inside the framework will start with the "ant_" prefix
followed by the file name where the definition can be found.
No underscores are allowed excepts the ones mentioned above. If any delimitations
are needed, then a dash will be used

For example the class definition "ant_wireframe-col-xs-1" can be found
inside the wireframe.css file. The class definition "ant_wireframe"
can also be found inside the wireframe.css file.

The classes that are just attributes for other definitions will not contain any
underscores, as they are not directly defined anywhere.

For example the class "ant-center" is only found near another class, like
.ant_wireframe.ant-center. In this case, the ant-center properties for the
wireframe class can be found inside the wireframe.css file.
