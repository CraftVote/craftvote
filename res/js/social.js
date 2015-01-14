/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var vote_project_id = 0;

VK.init({apiId: 4729747, onlyWidgets: true});

function authInfo(response) {
  if (response.session) {
    var req = new HttpRequest('/project/vote');
    req.send({ pr: vote_project_id });
  } else {
    vote_project_id = 0;
  }
}

function voteProject(project_id){
    
    vote_project_id = project_id;
    VK.Auth.login(authInfo);
}
