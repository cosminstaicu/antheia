Any css definition inside the framework will start with the "jsf_" prefix
followed by the file name where the definition can be found.
No underscores are allowed excepts the ones mentioned above. If any delimitations
are needed, then a dash will be used

For example the class definition "jsf_wireframe-col-xs-1" can be found
inside the wireframe.css file. The class definition "jsf_wireframe"
can also be found inside the wireframe.css file.

The classes that are just attributes for other definitions will not contain any
underscores, as they are not directly defined anywhere.

For example the class "jsf-center" is only found near another class, like
.jsf_wireframe.jsf-center. In this case, the jsf-center properties for the
wireframe class can be found inside the wireframe.css file.