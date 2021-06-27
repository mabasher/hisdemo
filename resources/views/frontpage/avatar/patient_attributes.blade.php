
    <div class="container py-7">
        <div class="row">
            <div class="mx-auto bg-white rounded shadow animate__animated animate__fadeInLeft animate__fast">
                <div class="text-center mt-2">
                    <h4 class="text-success" id="bodyPartName"></h4>
                </div>
                <div class="table-responsive tabscroll">
                    <table class="table">
                        <tbody>
                            @foreach($avatarAttributes as $avat)
                            <tr>
                                <td width="60px"><input class="attribName" type="checkbox" value="{{$avat->atr_name}}" name="atr_no[]"></td>
                                <td >{{$avat->atr_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center">
                    <button href="javascript:void(0)" id="attribId" type="button"  class="btn btn-sm btn-block btn-success " data-position="mb">
                            <span class="glyphicon glyphicon-retweet"></span>&nbsp; Cheif Complaint
                    </button>
                </div>
            </div>
        </div>
    </div>
