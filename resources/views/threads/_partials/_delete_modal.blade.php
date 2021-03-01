                        <div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/xf/destroy/{{$comment_id}}/comment" method="POST">
                                         {{ method_field('DELETE') }}
                                         <div class="modal-header">
                                              {{ csrf_field() }}
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">{{ $title }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! $body !!}
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="de_com" value="{{ $title }}" class="btn btn-danger">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
