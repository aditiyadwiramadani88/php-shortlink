const link = document.querySelector('#link')
const form = document.querySelector('form')
const label = document.querySelector('label')

// submit event 
form.addEventListener('submit', (e) => {

    e.preventDefault()
    
    // post data 
    async function get_data() { 
    let response  = await fetch('/get', {
    method: "POST", 
    body: new FormData(form)
    })

return response.json()
}

get_data().then((data) => {
    console.log(data)
    if(data['status']) { 
   link.style.border = "2px solid #f44336"
   
}else { 
    
    link.style.border = "2px solid #4CAF50"
    link.value = location.href + data['data']
    label.innerHTML = "Your Link"
      
    }
 })




  })
